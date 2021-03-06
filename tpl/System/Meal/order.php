<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{:U('Meal/order')}" class="on">订单列表</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="{:U('Meal/order')}" method="get">
							<input type="hidden" name="c" value="Meal"/>
							<input type="hidden" name="a" value="order"/>
							筛选: <input type="text" name="keyword" class="input-text" value="{$_GET['keyword']}"/>
							<select name="searchtype">
								<option value="order_id" <if condition="$_GET['searchtype'] eq 'order_id'">selected="selected"</if>>订单编号</option>
								<option value="s_name" <if condition="$_GET['searchtype'] eq 's_name'">selected="selected"</if>>店铺名称</option>
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
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>商家名称</th>
								<th>店铺名称</th>
								<th>{$config.meal_alias_name}人</th>
								<th>电话</th>
								<th>下单时间</th>
								<th>总价</th>
								<th>优惠</th>
								<th>状态</th>
								<th>支付状态</th>
								<th>支付方式</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($order_list)">
								<volist name="order_list" id="vo">
									<tr>
										<td>{$vo.order_id}</td>
										<td>{$vo.merchant_name}</td>
										<td>{$vo.store_name}</td>
										<td>{$vo.name}</td>
										<td>{$vo.phone}</td>
										<td>{$vo.dateline|date="Y-m-d H:i:s",###}</td>
										<td>￥<if condition="$vo['total_price'] gt 0">{$vo['total_price']}<else />{$vo.price}</if></td>
										<td>￥{$vo.minus_price}</td>
										<td>
										<if condition="$vo['status'] eq 0"><span style="color:red">未使用</span>
										<elseif condition="$vo['status'] eq 1" /><span style="color:green">已使用<strong>未评价</strong></span>
										<elseif condition="$vo['status'] eq 2" /><span style="color:green">已使用已评价</span>
										<elseif condition="$vo['status'] eq 3" /><span style="color:red"><del>订单被取消</del></span>
										<elseif condition="$vo['status'] eq 4" /><span style="color:red"><del>订单被取消</del></span>
										</if>
										</td>
										<td>
										<if condition="$vo['paid'] eq 0">
										<span style="color:red">未支付</span>
										<elseif condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" />
										<span style="color:red">线下未支付</span>
										<elseif condition="$vo['paid'] eq 2"  />
										<span style="color:green">已付￥{$vo['pay_money']}</span>，<span style="color:red">未付￥{$vo['price'] - $vo['pay_money']}</span>
										<else />
										<span style="color:green">全额支付</span>
										</if>
										</td>
										
										<td>
										<if condition="$vo['pay_type'] eq 'alipay'">
										<span style="color:green">支付宝</span>
										<elseif condition="$vo['pay_type'] eq 'weixin'"/>
										<span style="color:green">微信支付</span>
										<elseif condition="$vo['pay_type'] eq 'tenpay'"/>
										<span style="color:green">财付通[wap手机]</span>
										<elseif condition="$vo['pay_type'] eq 'tenpaycomputer'"/>
										<span style="color:green">财付通[即时到帐]</span>
										<elseif condition="$vo['pay_type'] eq 'yeepay'"/>
										<span style="color:green">易宝支付</span>
										<elseif condition="$vo['pay_type'] eq 'allinpay'"/>
										<span style="color:green">通联支付</span>
										<elseif condition="$vo['pay_type'] eq 'daofu'"/>
										<span style="color:green">货到付款</span>
										<elseif condition="$vo['pay_type'] eq 'dianfu'"/>
										<span style="color:green">到店付款</span>
										<elseif condition="$vo['pay_type'] eq 'chinabank'"/>
										<span style="color:green">网银在线</span>
										<elseif condition="$vo['pay_type'] eq 'offline'"/>
										<span style="color:green">线下支付</span>
										<else />
										<span style="color:green">暂未选择</span>
										</if>
										</td>
										<td class="textcenter">
											<a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Meal/order_detail',array('order_id'=>$vo['order_id'],'frame_show'=>true))}','查看{$config.meal_alias_name}详情',480,380,true,false,false,false,'detail',true);">查看</a>
									  	</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="12">{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="12">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>