<?php
class bloglistModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('list.tpl');
        $posts = new DbQuery();
        $posts->select('*');
        $posts->from('post');
        $result =  Db::getInstance()->executeS($posts);
        if ($result) {
            foreach ($result as $post) {
                $post["link"] = $this->context->link->getModuleLink('blog', 'detail',
                array(
                    'id' => $post["id_post"]
                ));
                $blog_post[] = $post;
            }
            $this->context->smarty->assign("posts", $blog_post);
        }
    }

}
