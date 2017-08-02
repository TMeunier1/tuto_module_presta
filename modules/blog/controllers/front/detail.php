<?php
class blogdetailModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('detail.tpl');
        $post_id = Tools::getValue("id");
        $posts = new DbQuery();
        $posts->select('*');
        $posts->from('post');
        $posts->where('id_post ='.$post_id);
        $result =  Db::getInstance()->executeS($posts);
        if ($result) {
            $this->context->smarty->assign("post", $result);
        }
    }

}
