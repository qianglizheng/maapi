<?php

namespace app\api\controller\admin\v1;
use think\facade\Db;

class Menu
{
    /**
     * 获取初始化数据
     */
    public function menu()
    {
        $homeInfo =  [
            "title" => "首页",
            "href" => "/admin/index/index2"
        ];
        $logoInfo =  [
            "title" => "小码API",
            "image" => "/static/images/logo.png",
            "href" => ""
        ];
        $menuInfo = $this->getMenuList();
        $systemInit = [
            'homeInfo' => $homeInfo,
            'logoInfo' => $logoInfo,
            'menuInfo' => $menuInfo,
        ];
        return json($systemInit);
    }

    /**
     * 获取菜单列表
     * */
    private function getMenuList()
    {
        $menuList = Db::name('system_menu')
            ->field('id,pid,title,icon,href,target')
            ->where('status', 1)
            ->order('sort', 'desc')
            ->select();
        $menuList = $this->buildMenuChild(0, $menuList);
        return $menuList;
    }

    /**
     * 递归获取子菜单
     * */
    private function buildMenuChild($pid, $menuList)
    {
        $treeList = [];
        foreach ($menuList as $v) {
            if ($pid == $v['pid']) {
                $node = $v;
                $child = $this->buildMenuChild($v['id'], $menuList);
                if (!empty($child)) {
                    $node['child'] = $child;
                }
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }
        return $treeList;
    }
}
