<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{:U('Classify/cat_field',array('cid'=>$now_category['cid']))}" class="on">字段列表</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Classify/cat_field_add',array('cid'=>$now_category['cid']))}','添加字段',600,400,true,false,false,addbtn,'add',true);">添加字段</a><if condition="$now_category['subdir'] gt 1 AND empty($now_category['cat_field']) AND !$f_empty_cat_field"> | <a href="{:U('Classify/fieldInherit',array('cid'=>$now_category['cid'],'pcid'=>$now_category['fcid']))}" class="on">继承上级目录字段</a></if>
				</ul>
			</div>
			<form name="myqcorm" id="myqcorm" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<!--col/-->
							<col/>
							<col/>
							<col/>
							<!--col/-->
							<!--col width="180" align="center"/-->
						</colgroup>
						<thead>
							<tr>
								<!--th>排序</th-->
								<th>名称</th>
								<th>短标记(url)</th>
								<th>类型</th>
								<th>筛选字段</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($now_category['cat_field'])">
								<volist name="now_category['cat_field']" id="vo">
									<tr>
										<!--td>{$vo.sort}</td-->
										<td>{$vo.name}</td>
										<td>{$vo.url}</td>
										<td>{$inputTypeArr[$vo['type']]['tname']}</td>
										<td><if condition="$vo['isfilter'] eq 1"> 是 <else/> 否 </if></td>
										<td><a href="javascript:void(0);" onclick="window.top.artiframe('{:U('Classify/cat_field_edit',array('cid'=>$now_category['cid'],eid=>$key))}','编辑字段',600,400,true,false,false,editbtn,'edit',true);">编辑</a></td>
										<!--td><if condition="$vo['status'] eq 1"><font color="green">显示</font><else/><font color="red">隐藏</font></if></td-->
										<!--td class="textcenter"><a href="javascript:void(0);" class="delete_row" parameter="cat_id={$vo.cat_id}" url="{:U('Classify/cat_del')}">删除</a></td-->
									</tr>
								</volist>
							<else/>
								<tr><td class="textcenter red" colspan="5">商品属性字段 列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>