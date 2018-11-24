<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/24
 * Time: 上午10:37
 */
namespace App\Http\Controllers\Admin\Bbs;
use App\Http\Controllers\Api\BaseController;
use App\Service\BbsLableService;
use Illuminate\Http\Request;
use Validator;

class BbsLableController extends BaseController{
    /**
     * 获取列表
     * Name: getList
     * User: zhangying
     * Date: 2018/11/24
     * Time: 上午11:18
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request){
        $page       = $request->page;       //页码
        $limit      = $request->limit ? $request->limit : 20;      //每页显示数量

        $bbsLableService = BbsLableService::singleton();
        $list = $bbsLableService->getList($page,$limit);
        if($list){
            return $this->success($list);
        }else{
            return $this->fail('204',[]);
        }
    }

    /**
     * 添加标签
     * Name: postAdd
     * User: zhangying
     * Date: 2018/11/24
     * Time: 上午11:18
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAdd(Request $request){
        try{
            $validator = Validator::make($request->input(), [
                'label_name' => 'required|max:20',
                'status'     => 'required|in:1,0',
            ]);
            $attrs = array(
                'label_name' => '标签名称',
                'status'     => '标签状态',
            );
            $validator->setAttributeNames($attrs);
            if ($validator->fails()) {
                // 如果有错误，提示第一条
                $result = $this->fail(204,$validator->errors()->all()[0],[]);
                return $result;
            }
            $info['label_name'] = $request->input('label_name');
            $info['status']     =$request->input('status');
            $info['admin_uid']  = 1;
            $res = BbsLableService::singleton()->add($info);
            if($res['code']==1){
                return $this->success([],$res['message']);
            }else{
                return $this->fail(204,$res['message']);
            }
        }catch (\Exception $e){
            return $this->fail(204,'提交失败！');
        }
    }

    public function postEdit(Request $request){
        try{
            $validator = Validator::make($request->input(), [
                'id' => 'required|max:20',
                'label_name' => 'required|max:20',
                'status'     => 'required|in:1,0',
            ]);
            $attrs = array(
                'id' => '标签ID',
                'label_name' => '标签名称',
                'status'     => '标签状态',
            );
            $validator->setAttributeNames($attrs);
            if ($validator->fails()) {
                // 如果有错误，提示第一条
                $result = $this->fail(204,$validator->errors()->all()[0],[]);
                return $result;
            }
            $id = $request->input('id');
            $info['label_name'] = $request->input('label_name');
            $info['status']     =$request->input('status');
            $info['admin_uid']  = 1;
            $res = BbsLableService::singleton()->edit($info,$id);
            if($res['code']==1){
                return $this->success([],$res['message']);
            }else{
                return $this->fail(204,$res['message']);
            }
        }catch (\Exception $e){
            return $this->fail(204,'修改失败！');
        }
    }
}