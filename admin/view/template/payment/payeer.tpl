<? echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <? foreach ($breadcrumbs as $breadcrumb) { ?>
    <? echo $breadcrumb['separator']; ?><a href="<? echo $breadcrumb['href']; ?>"><? echo $breadcrumb['text']; ?></a>
    <? } ?>
  </div>
  <? if ($error_warning) { ?>
  <div class="warning"><? echo $error_warning; ?></div>
  <? } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <? echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><? echo $button_save; ?></a><a href="<? echo $cancel; ?>" class="button"><? echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<? echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
		 <tr>
            <td><? echo $entry_status; ?></td>
            <td><select name="payeer_status">
                <? if ($payeer_status) { ?>
                <option value="1" selected="selected"><? echo $text_enabled; ?></option>
                <option value="0"><? echo $text_disabled; ?></option>
                <? } else { ?>
                <option value="1"><? echo $text_enabled; ?></option>
                <option value="0" selected="selected"><? echo $text_disabled; ?></option>
                <? } ?>
              </select></td>
          </tr>
		 <tr>
            <td><? echo $entry_order_status; ?></td>
            <td><select name="payeer_order_status_id">
                <? foreach ($order_statuses as $order_status) { ?>
                <? if ($order_status['order_status_id'] == $payeer_order_status_id) { ?>
                <option value="<? echo $order_status['order_status_id']; ?>" selected="selected"><? echo $order_status['name']; ?></option>
                <? } else { ?>
                <option value="<? echo $order_status['order_status_id']; ?>"><? echo $order_status['name']; ?></option>
                <? } ?>
                <? } ?>
              </select></td>
          </tr>
		  <tr>
            <td><? echo $entry_geo_zone; ?></td>
            <td><select name="payeer_geo_zone_id">
                <option value="0"><? echo $text_all_zones; ?></option>
                <? foreach ($geo_zones as $geo_zone) { ?>
                <? if ($geo_zone['geo_zone_id'] == $payeer_geo_zone_id) { ?>
                <option value="<? echo $geo_zone['geo_zone_id']; ?>" selected="selected"><? echo $geo_zone['name']; ?></option>
                <? } else { ?>
                <option value="<? echo $geo_zone['geo_zone_id']; ?>"><? echo $geo_zone['name']; ?></option>
                <? } ?>
                <? } ?>
              </select></td>
          </tr>
		  <tr>
            <td><? echo $entry_sort_order; ?></td>
            <td><input type="text" name="payeer_sort_order" value="<? echo $payeer_sort_order; ?>" size="1" /></td>
          </tr>
		  <tr>
			<td colspan=2><? echo $entry_title_pay_settings; ?></td>
		  </tr>
		  <tr>
            <td><? echo $entry_url; ?></td>
            <td><input type="text" name="payeer_url" value="<? echo $payeer_url; ?>" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <? echo $entry_merchant; ?></td>
            <td><input type="text" name="payeer_merchant" value="<? echo $payeer_merchant; ?>" />
              <? if ($error_merchant) { ?>
              <span class="error"><? echo $error_merchant; ?></span>
              <? } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <? echo $entry_security; ?></td>
            <td><input type="text" name="payeer_security" value="<? echo $payeer_security; ?>" />
              <? if ($error_security) { ?>
              <span class="error"><? echo $error_security; ?></span>
              <? } ?></td>
          </tr>
		  <tr>
            <td><? echo $entry_order_desc; ?></td>
            <td><input type="text" name="payeer_order_desc" value="<? echo $payeer_order_desc; ?>" size="60"/></td>
          </tr>
		  <tr>
            <td><? echo $entry_log; ?></td>
            <td><input type="text" name="payeer_log_value" value="<? echo $payeer_log_value; ?>" size="60"/></td>
          </tr>
		  <tr>
            <td><? echo $entry_list_ip; ?></td>
            <td><input type="text" name="list_ip" value="<? echo $list_ip; ?>" size="60"/></td>
          </tr>
		  <tr>
            <td><? echo $entry_admin_email; ?></td>
            <td><input type="text" name="admin_email" value="<? echo $admin_email; ?>" size="60"/></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<? echo $footer; ?> 