<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{:U('Merchant/wait_merchant')}" class="on">待审核商户列表</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="{:U('Merchant/wait_merchant')}" method="get">
							<input type="hidden" name="c" value="Merchant"/>
							<input type="hidden" name="a" value="wait_merchant"/>
							筛选: <input type="text" name="keyword" class="input-text" value="{$_GET['keyword']}"/>
							<select name="searchtype">
								<option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>商户名称</option>								
								<option value="account" <if condition="$_GET['searchtype'] eq 'account'">selected="selected"</if>>商户帐号</option>
								<option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>联系电话</option>
								<option value="mer_id" <if condition="$_GET['searchtype'] eq 'mer_id'">selected="selected"</if>>商家编号</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myqcorm" id="myqcorm" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col> <col><col><col><col><col><col width="240" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>商户帐号</th>
								<th>商户名称</th>
								<th>联系电话</th>
								<th>最后登录时间</th>
								<th class="textcenter">访问该商户后台</th>
								<th class="textcenter">微官网点击数</th>
								<th>状态</th>
								<if condition="$config['is_open_oauth']">
								<th>公众号网页授权状态</th>
								</if>
								<th class="textcenter">商家账单</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($merchant_list)">
								<volist name="merchant_list" id="vo">
									<tr>
										<td>{$vo.mer_id}</td>
										<td>{$vo.account}</td>
										<td>{$vo.name}</td>
										<td>{$vo.phone}</td>
										<td><if condition="$vo['last_time']">{$vo.last_time|date='Y-m-d H:i:s',###}<else/>无</if></td>
										<td class="textcenter"><if condition="$vo['status'] eq 1"><a href="{:U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id']))}" class="__full_screen_link" target="_blank">访问</a><else/><a href="javascript:alert('商户状态不正常，无法访问！请先修改商户状态。');" class="__full_screen_link">访问</a></if></td>
										<td class="textcenter">{$vo.hits}</td>
										<td><if condition="$vo['status'] eq 1"><font color="green">启用</font><elseif condition="$vo['status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>
										<if condition="$config['is_open_oauth']">
										<td><if condition="$vo['is_open_oauth'] eq 1"><font color="green">启用</font><else/><font color="red">关闭</font></if></td>
										</if>
										<td class="textcenter"><a href="{:U('Merchant/order',array('mer_id'=>$vo['mer_id']))}">查看账单</a></td>
										<td class="textcenter">
										<a href="{:U('Merchant/store',array('mer_id'=>$vo['mer_id']))}">店铺列表</a> | 
										<a href="javascript:void(0);" onclick="window.top.show_other_frame('Group','product','mer_id={$vo.mer_id}')">{$config.group_alias_name}列表</a> | 
										<a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Merchant/edit',array('mer_id'=>$vo['mer_id'],'frame_show'=>true))}','查看详细信息',520,370,true,false,false,false,'detail',true);">查看</a> | 
										<a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Merchant/edit',array('mer_id'=>$vo['mer_id']))}','编辑商户信息',600,450,true,false,false,editbtn,'edit',true);">编辑</a> | 
										<a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Merchant/menu',array('mer_id'=>$vo['mer_id']))}','设置商家使用权限',700,500,true,false,false,editbtn,'edit',true);">设置商家使用权限</a> | 
										<a href="javascript:void(0);" class="delete_row" parameter="mer_id={$vo.mer_id}" url="{:U('Merchant/del')}">删除</a>
										</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="11">{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="11">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>