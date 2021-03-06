<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{:U('Group/order')}" class="on">订单列表</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="{:U('Group/order')}" method="get">
							<input type="hidden" name="c" value="Group"/>
							<input type="hidden" name="a" value="order"/>
							筛选: <input type="text" name="keyword" class="input-text" value="{$_GET['keyword']}"/>
							<select name="searchtype">
								<option value="order_id" <if condition="$_GET['searchtype'] eq 'order_id'">selected="selected"</if>>订单编号</option>
								<option value="s_name" <if condition="$_GET['searchtype'] eq 's_name'">selected="selected"</if>>{$config.group_alias_name}名称</option>
								<option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>客户名称</option>
								<option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>客户电话</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			
			<form name="myqcorm" id="myqcorm" action="" method="post">
				<div class="table-list">
					<style>
					.table-list td{line-height:22px;padding-top:5px;padding-bottom:5px;}
					</style>
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col width="100" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>订单编号</th>
								<th>商家信息</th>
								<th>{$config.group_alias_name}信息</th>
								<th>订单信息</th>
								<th>订单用户</th>
								<th>查看用户信息</th>
								<th>订单状态</th>
								<th>时间</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($order_list)">
								<volist name="order_list" id="vo">
									<tr>
										<td>{$vo.order_id}</td>
										<td>商家ID：{$vo.mer_id}　商家电话：{$vo.m_phone}<br/>商家名称：{$vo.m_name}</td>
										<td>{$config.group_alias_name}ID：{$vo.group_id}　{$config.group_alias_name}价：￥{$vo.g_price}<br/>{$config.group_alias_name}名称：{$vo.s_name}</td>
										<td>数量：{$vo.num}<br/>总价：￥{$vo.total_money|floatval=###}</td>
										<td>用户名：{$vo.nickname}<br/>订单手机号：{$vo.group_phone}</td>
										<td>
											<a href="javascript:void(0);" onclick="window.top.artiframe('{:U('User/edit',array('uid'=>$vo['uid']))}','编辑用户信息',680,560,true,false,false,editbtn,'edit',true);">查看用户信息</a>
										</td>
										<td>
											<if condition="$vo['status'] eq 3">
												<font color="blue">已取消</font>
											<elseif condition="$vo['paid'] eq 1"/>
												<if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" >
													<font color="red">线下支付&nbsp;未付款</font>
												<elseif condition="$vo['status'] eq 0" />
													<font color="green">已付款</font>&nbsp;
													<php>if($vo['tuan_type'] != 2){</php>
														<font color="red">未消费</font>
													<php>}else{</php>
														<font color="red">未发货</font>
													<php>}</php>
												<elseif condition="$vo['status'] eq 1"/>
													<php>if($vo['tuan_type'] != 2){</php>
														<font color="green">已消费</font>
													<php>}else{</php>
														<font color="green">已发货</font>
													<php>}</php>&nbsp;
													<font color="red">待评价</font>
												<else/>
													<font color="green">已完成</font>
												</if>
											<else/>
												<font color="red">未付款</font>
											</if>
										</td>
										<td>
											下单时间：{$vo['add_time']|date='Y-m-d H:i:s',###}<br/>
											<if condition="$vo['paid']">付款时间：{$vo['pay_time']|date='Y-m-d H:i:s',###}</if>
										</td>
										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Group/order_edit',array('order_id'=>$vo['order_id']))}','查看订单详情',600,460,true,false,false,false,'order_edit',true);">查看详情</a></td>
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