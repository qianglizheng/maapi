<?php

declare(strict_types=1);

namespace app\api\controller\user\v1;

use app\common\controller\Common;
use think\Request;
use app\common\model\Apps as AppsModel;

class Apps extends Common
{
    public function __construct()
    {
        $this->model = new AppsModel();
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($page, $limit)
    {
        $page = ($page -1)*$limit;//定义偏移量
        $count = $this->model->count();//获取数据条数
        $data = $this->model->limit($page, $limit)->order('id desc')->select();
        if ($data->isEmpty()) {
            return $this->returnJson($count, $data, '数据不存在');
        } else {
            return $this->returnJson($count, $data);
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        return 'read';
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
