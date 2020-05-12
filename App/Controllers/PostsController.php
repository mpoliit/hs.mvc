<?php


namespace Controllers;


use Core\AbsController;
use Core\View;
use Helpers\ImageHelpers;
use Helpers\SessionHelpers;
use Models\Post;
use Models\User;
use Validator\Post\PostValidator;

class PostsController extends AbsController
{
    public function index(){
        print_r(__METHOD__);
    }

    public function create()
    {
        $this->before();
        View::render('post/create.php');
    }

    public function store()
    {
        $this->before();

        if($_FILES['image']['error'] != 0){
            $this->data = [
                'data' => $_POST,
                'image_error' => 'Не выбрана картинка'
            ];
            View::render('post/create.php', $this->data);
            exit();
        }

        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $postValidate   = new PostValidator();
        $imageHelper    = new ImageHelpers();

        if ($postValidate->validate($fields)){

            $imagePath = $imageHelper->upload($_FILES['image']);

            $fields['image']    = $imagePath;
            $fields['user_id']  = SessionHelpers::getUserId();
            $post = new Post();
            $newPost = $post->insert($fields);

            if ($newPost){
                redirect("/post/$newPost/view");
            } else {
                die('Ошибка при создании новости в бд');
            }
        }

        $this->data['data'] = $fields;
        $this->data += $postValidate->getErrors();

        View::render('post/create.php', $this->data);
    }

    protected function before()
    {
        parent::before();

        if (!SessionHelpers::isUserLogin()){
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Вы должны быть авторизированы'
            ];
            redirect('login');
            die();
        }
    }

    public function view(int $id)
    {
        $post = new Post();
        $user = new User();

        $postData = $post->selectPostById($id);
        $userName = $user->getUserById($postData['user_id']);

        $postData['author_name'] = $userName['first_name'] . ' ' . $userName['last_name'];

        View::render('post/view.php', $postData);
    }

    public function delete(int $id){

        $post = new Post();
        $postData = $post->selectPostById($id);

        if ((int)SessionHelpers::getUserId() != $postData['user_id']){
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Для удаления необходимо быть автором'
            ];
            redirect('');
            exit();
        } else {
            $post->delete($id);
            $_SESSION['notification'] = [
                'type' => 'success',
                'message' => 'Запись удалена'
            ];
            unlink(ASSETS_PATH . $postData['image']);
            redirect('');
            exit();
        }
    }

    public function edit(int $id){

        $post = new Post();
        $postData = $post->selectPostById($id);

        if ((int)SessionHelpers::getUserId() != $postData['user_id']){
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Для изменения необходимо быть автором'
            ];
            redirect('');
            exit();
        } else {
            View::render('post/edit.php', $postData);
        }
    }

    public function update($id)
    {
        $this->before();

        $fields = filter_input_array(INPUT_POST, $_POST, 1);
        $postValidate   = new PostValidator();

        if ($postValidate->validate($fields)){

            if($_FILES['image']['error'] == 0) {
                $imageHelper = new ImageHelpers();
                $imagePath = $imageHelper->upload($_FILES['image']);
                $fields['image']    = $imagePath;
            }
            $fields['id']  = $id;
            $post = new Post();
            $updatePost = $post->update($fields);

            if ($updatePost){
                redirect("/post/$id/view");
            } else {
                die('Ошибка при обновлении новости в бд');
            }
        }

        $this->data['data'] = $fields;
        $this->data += $postValidate->getErrors();

        View::render("post/$id/edit.php", $this->data);
    }

    public function postOneUser(int $id)
    {
        $post = new Post();
        $user = new User();

        $postsData = $post->selectPostByUserId($id);
        $userName = $user->getUserById($id);

        View::render('post/one_user_view.php', ['posts' => $postsData, 'user_name' => $userName['first_name'] . ' ' . $userName['last_name']]);
    }
}