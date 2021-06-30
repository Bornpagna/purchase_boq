    $('#dashboard').on('ifChanged',function(){
        if (this.checked) {
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {}else{
                $('#dash-request').iCheck('check');
                $('#dash-order').iCheck('check');
                $('#dash-delivery').iCheck('check');
                $('#dash-usage').iCheck('check');
                $('#dash-chart-request-item').iCheck('check');
                $('#dash-chart-order-item').iCheck('check');
                $('#dash-chart-order-price').iCheck('check');
                $('#dash-chart-house-type').iCheck('check');
            }
        }else{
            $('#dash-request').iCheck('uncheck');
            $('#dash-order').iCheck('uncheck');
            $('#dash-delivery').iCheck('uncheck');
            $('#dash-usage').iCheck('uncheck');
            $('#dash-chart-request-item').iCheck('uncheck');
            $('#dash-chart-order-item').iCheck('uncheck');
            $('#dash-chart-order-price').iCheck('uncheck');
            $('#dash-chart-house-type').iCheck('uncheck');
        }
    });

    $('#setup_option').on('ifChanged',function(){
        if (this.checked) {
            if ($('#zone').prop('checked')==true
            || $('#zone_add').prop('checked')==true
            || $('#zone_edit').prop('checked')==true
            || $('#zone_delete').prop('checked')==true
            || $('#zone_download').prop('checked')==true
            || $('#zone_upload').prop('checked')==true
			
			|| $('#constructor').prop('checked')==true
			|| $('#constructor_add').prop('checked')==true
            || $('#constructor_edit').prop('checked')==true
            || $('#constructor_delete').prop('checked')==true
            || $('#constructor_download').prop('checked')==true
            || $('#constructor_upload').prop('checked')==true
			
			|| $('#warehouse').prop('checked')==true
			|| $('#warehouse_add').prop('checked')==true
            || $('#warehouse_edit').prop('checked')==true
            || $('#warehouse_delete').prop('checked')==true
            || $('#warehouse_download').prop('checked')==true
            || $('#warehouse_upload').prop('checked')==true
			
            || $('#block').prop('checked')==true
            || $('#block_add').prop('checked')==true
            || $('#block_edit').prop('checked')==true
            || $('#block_delete').prop('checked')==true
            || $('#block_download').prop('checked')==true
            || $('#block_upload').prop('checked')==true
			
            || $('#street').prop('checked')==true
            || $('#street_add').prop('checked')==true
            || $('#street_edit').prop('checked')==true
            || $('#street_delete').prop('checked')==true
            || $('#street_download').prop('checked')==true
            || $('#street_upload').prop('checked')==true) {}else{
                $('#zone').iCheck('check');
                $('#zone_add').iCheck('check');
                $('#zone_edit').iCheck('check');
                $('#zone_delete').iCheck('check');
                $('#zone_download').iCheck('check');
                $('#zone_upload').iCheck('check');
				
                $('#block').iCheck('check');
                $('#block_add').iCheck('check');
                $('#block_edit').iCheck('check');
                $('#block_delete').iCheck('check');
                $('#block_download').iCheck('check');
                $('#block_upload').iCheck('check');
				
                $('#street').iCheck('check');
                $('#street_add').iCheck('check');
                $('#street_edit').iCheck('check');
                $('#street_delete').iCheck('check');
                $('#street_download').iCheck('check');
                $('#street_upload').iCheck('check');
				
				$('#constructor').iCheck('check');
                $('#constructor_add').iCheck('check');
                $('#constructor_edit').iCheck('check');
                $('#constructor_delete').iCheck('check');
                $('#constructor_download').iCheck('check');
                $('#constructor_upload').iCheck('check');
				
				$('#warehouse').iCheck('check');
                $('#warehouse_add').iCheck('check');
                $('#warehouse_edit').iCheck('check');
                $('#warehouse_delete').iCheck('check');
                $('#warehouse_download').iCheck('check');
                $('#warehouse_upload').iCheck('check');
            }
        }else{
            $('#zone').iCheck('uncheck');
            $('#zone_add').iCheck('uncheck');
            $('#zone_edit').iCheck('uncheck');
            $('#zone_delete').iCheck('uncheck');
            $('#zone_download').iCheck('uncheck');
            $('#zone_upload').iCheck('uncheck');
			
            $('#block').iCheck('uncheck');
            $('#block_add').iCheck('uncheck');
            $('#block_edit').iCheck('uncheck');
            $('#block_delete').iCheck('uncheck');
            $('#block_download').iCheck('uncheck');
            $('#block_upload').iCheck('uncheck');
			
            $('#street').iCheck('uncheck');
            $('#street_add').iCheck('uncheck');
            $('#street_edit').iCheck('uncheck');
            $('#street_delete').iCheck('uncheck');
            $('#street_download').iCheck('uncheck');
            $('#street_upload').iCheck('uncheck');
			
			$('#constructor').iCheck('uncheck');
            $('#constructor_add').iCheck('uncheck');
            $('#constructor_edit').iCheck('uncheck');
            $('#constructor_delete').iCheck('uncheck');
            $('#constructor_download').iCheck('uncheck');
            $('#constructor_upload').iCheck('uncheck');
			
			$('#warehouse').iCheck('uncheck');
            $('#warehouse_add').iCheck('uncheck');
            $('#warehouse_edit').iCheck('uncheck');
            $('#warehouse_delete').iCheck('uncheck');
            $('#warehouse_download').iCheck('uncheck');
            $('#warehouse_upload').iCheck('uncheck');
        }
    });

    $('#item_info').on('ifChanged',function(){
        if (this.checked) {
            if ($('#item_type').prop('checked')==true
            || $('#item_type_add').prop('checked')==true
            || $('#item_type_edit').prop('checked')==true
            || $('#item_type_delete').prop('checked')==true
            || $('#item_type_download').prop('checked')==true
            || $('#item_type_upload').prop('checked')==true
			
            || $('#unit').prop('checked')==true
            || $('#unit_add').prop('checked')==true
            || $('#unit_edit').prop('checked')==true
            || $('#unit_delete').prop('checked')==true
			|| $('#unit_download').prop('checked')==true
            || $('#unit_upload').prop('checked')==true
			
			|| $('#item').prop('checked')==true
            || $('#item_add').prop('checked')==true
            || $('#item_edit').prop('checked')==true
            || $('#item_delete').prop('checked')==true
			|| $('#item_download').prop('checked')==true
            || $('#item_upload').prop('checked')==true
			
			|| $('#supplier').prop('checked')==true
            || $('#supplier_add').prop('checked')==true
            || $('#supplier_edit').prop('checked')==true
            || $('#supplier_delete').prop('checked')==true
			|| $('#supplier_download').prop('checked')==true
            || $('#supplier_upload').prop('checked')==true
			
            || $('#supplier_item').prop('checked')==true
            || $('#supplier_item_add').prop('checked')==true
            || $('#supplier_item_edit').prop('checked')==true
            || $('#supplier_item_delete').prop('checked')==true
			|| $('#supplier_item_download').prop('checked')==true) {}else{

                $('#item_type').iCheck('check');
                $('#item_type_add').iCheck('check');
                $('#item_type_edit').iCheck('check');
                $('#item_type_delete').iCheck('check');
                $('#item_type_download').iCheck('check');
                $('#item_type_upload').iCheck('check');
				
				$('#unit').iCheck('check');
                $('#unit_add').iCheck('check');
                $('#unit_edit').iCheck('check');
                $('#unit_delete').iCheck('check');
                $('#unit_download').iCheck('check');
                $('#unit_upload').iCheck('check');
				
				$('#item').iCheck('check');
                $('#item_add').iCheck('check');
                $('#item_edit').iCheck('check');
                $('#item_delete').iCheck('check');
                $('#item_download').iCheck('check');
                $('#item_upload').iCheck('check');
				
				$('#supplier').iCheck('check');
                $('#supplier_add').iCheck('check');
                $('#supplier_edit').iCheck('check');
                $('#supplier_delete').iCheck('check');
                $('#supplier_download').iCheck('check');
                $('#supplier_upload').iCheck('check');
				
				$('#supplier_item').iCheck('check');
                $('#supplier_item_add').iCheck('check');
                $('#supplier_item_edit').iCheck('check');
                $('#supplier_item_delete').iCheck('check');
                $('#supplier_item_download').iCheck('check');
            }
        }else{
            $('#item_type').iCheck('uncheck');
            $('#item_type_add').iCheck('uncheck');
            $('#item_type_edit').iCheck('uncheck');
            $('#item_type_delete').iCheck('uncheck');
            $('#item_type_download').iCheck('uncheck');
            $('#item_type_upload').iCheck('uncheck');
			
			$('#unit').iCheck('uncheck');
            $('#unit_add').iCheck('uncheck');
            $('#unit_edit').iCheck('uncheck');
            $('#unit_delete').iCheck('uncheck');
            $('#unit_download').iCheck('uncheck');
            $('#unit_upload').iCheck('uncheck');
			
			$('#item').iCheck('uncheck');
            $('#item_add').iCheck('uncheck');
            $('#item_edit').iCheck('uncheck');
            $('#item_delete').iCheck('uncheck');
            $('#item_download').iCheck('uncheck');
            $('#item_upload').iCheck('uncheck');
			
			$('#supplier').iCheck('uncheck');
            $('#supplier_add').iCheck('uncheck');
            $('#supplier_edit').iCheck('uncheck');
            $('#supplier_delete').iCheck('uncheck');
            $('#supplier_download').iCheck('uncheck');
            $('#supplier_upload').iCheck('uncheck');
			
			$('#supplier_item').iCheck('uncheck');
            $('#supplier_item_add').iCheck('uncheck');
            $('#supplier_item_edit').iCheck('uncheck');
            $('#supplier_item_delete').iCheck('uncheck');
            $('#supplier_item_download').iCheck('uncheck');
        }
    });
	
	$('#house_info').on('ifChanged',function(){
        if (this.checked) {
            if ($('#house_type').prop('checked')==true
            || $('#house_type_add').prop('checked')==true
            || $('#house_type_edit').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
            || $('#house_type_download').prop('checked')==true
            || $('#house_type_upload').prop('checked')==true
            || $('#house_type_enter_boq').prop('checked')==true
            || $('#house_type_upload_boq').prop('checked')==true
			
            || $('#house').prop('checked')==true
            || $('#house_add').prop('checked')==true
            || $('#house_edit').prop('checked')==true
            || $('#house_delete').prop('checked')==true
			|| $('#house_download').prop('checked')==true
            || $('#house_upload').prop('checked')==true
            || $('#house_enter_boq').prop('checked')==true
            || $('#house_upload_boq').prop('checked')==true
			
			|| $('#boq').prop('checked')==true
            || $('#boq_add').prop('checked')==true
            || $('#boq_view').prop('checked')==true
            || $('#boq_delete').prop('checked')==true
			|| $('#boq_download').prop('checked')==true
            || $('#boq_download_sample').prop('checked')==true) {}else{
				
                $('#house_type').iCheck('check');
                $('#house_type_add').iCheck('check');
                $('#house_type_edit').iCheck('check');
                $('#house_type_delete').iCheck('check');
                $('#house_type_download').iCheck('check');
                $('#house_type_upload').iCheck('check');
                $('#house_type_enter_boq').iCheck('check');
                $('#house_type_upload_boq').iCheck('check');
				
				$('#house').iCheck('check');
                $('#house_add').iCheck('check');
                $('#house_edit').iCheck('check');
                $('#house_delete').iCheck('check');
                $('#house_download').iCheck('check');
                $('#house_upload').iCheck('check');
                $('#house_enter_boq').iCheck('check');
                $('#house_upload_boq').iCheck('check');
				
				$('#boq').iCheck('check');
                $('#boq_add').iCheck('check');
                $('#boq_view').iCheck('check');
                $('#boq_delete').iCheck('check');
                $('#boq_download').iCheck('check');
                $('#boq_download_sample').iCheck('check');
            }
        }else{
            $('#house_type').iCheck('uncheck');
            $('#house_type_add').iCheck('uncheck');
            $('#house_type_edit').iCheck('uncheck');
            $('#house_type_delete').iCheck('uncheck');
            $('#house_type_download').iCheck('uncheck');
            $('#house_type_upload').iCheck('uncheck');
            $('#house_type_enter_boq').iCheck('uncheck');
            $('#house_type_upload_boq').iCheck('uncheck');
			
			$('#house').iCheck('uncheck');
            $('#house_add').iCheck('uncheck');
            $('#house_edit').iCheck('uncheck');
            $('#house_delete').iCheck('uncheck');
            $('#house_download').iCheck('uncheck');
            $('#house_upload').iCheck('uncheck');
            $('#house_enter_boq').iCheck('uncheck');
            $('#house_upload_boq').iCheck('uncheck');
			
			$('#boq').iCheck('uncheck');
            $('#boq_add').iCheck('uncheck');
            $('#boq_view').iCheck('uncheck');
            $('#boq_delete').iCheck('uncheck');
            $('#boq_download').iCheck('uncheck');
            $('#boq_download_sample').iCheck('uncheck');
        }
    });
	
	$('#purchase').on('ifChanged',function(){
        if (this.checked) {
            if ($('#purchase_request').prop('checked')==true
			|| $('#purchase_request_add').prop('checked')==true
			|| $('#purchase_request_edit').prop('checked')==true
			|| $('#purchase_request_delete').prop('checked')==true
			|| $('#purchase_request_print').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true
			|| $('#purchase_request_view').prop('checked')==true
			
			|| $('#purchase_order').prop('checked')==true
			|| $('#purchase_order_add').prop('checked')==true
			|| $('#purchase_order_edit').prop('checked')==true
			|| $('#purchase_order_delete').prop('checked')==true
			|| $('#purchase_order_print').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true
			|| $('#purchase_order_view').prop('checked')==true) {}else{
				
                $('#purchase_request').iCheck('check');
                $('#purchase_request_add').iCheck('check');
                $('#purchase_request_edit').iCheck('check');
                $('#purchase_request_delete').iCheck('check');
                $('#purchase_request_print').iCheck('check');
                $('#purchase_request_clone').iCheck('check');
                $('#purchase_request_view').iCheck('check');
				
				$('#purchase_order').iCheck('check');
                $('#purchase_order_add').iCheck('check');
                $('#purchase_order_edit').iCheck('check');
                $('#purchase_order_delete').iCheck('check');
                $('#purchase_order_print').iCheck('check');
                $('#purchase_order_clone').iCheck('check');
                $('#purchase_order_view').iCheck('check');
            }
        }else{
            $('#purchase_request').iCheck('uncheck');
            $('#purchase_request_add').iCheck('uncheck');
            $('#purchase_request_edit').iCheck('uncheck');
            $('#purchase_request_delete').iCheck('uncheck');
            $('#purchase_request_print').iCheck('uncheck');
            $('#purchase_request_clone').iCheck('uncheck');
            $('#purchase_request_view').iCheck('uncheck');
			
			$('#purchase_order').iCheck('uncheck');
            $('#purchase_order_add').iCheck('uncheck');
            $('#purchase_order_edit').iCheck('uncheck');
            $('#purchase_order_delete').iCheck('uncheck');
            $('#purchase_order_print').iCheck('uncheck');
            $('#purchase_order_clone').iCheck('uncheck');
            $('#purchase_order_view').iCheck('uncheck');
        }
    });
	
	$('#approve').on('ifChanged',function(){
        if (this.checked) {
            if ($('#approve_request').prop('checked')==true
			|| $('#approve_request_view').prop('checked')==true
			|| $('#approve_request_signature').prop('checked')==true
			|| $('#approve_request_reject').prop('checked')==true
			
			|| $('#approve_order').prop('checked')==true
			|| $('#approve_order_view').prop('checked')==true
			|| $('#approve_order_signature').prop('checked')==true
			|| $('#approve_order_reject').prop('checked')==true) {}else{
				
                $('#approve_request').iCheck('check');
                $('#approve_request_view').iCheck('check');
                $('#approve_request_signature').iCheck('check');
                $('#approve_request_reject').iCheck('check');
				
				$('#approve_order').iCheck('check');
                $('#approve_order_view').iCheck('check');
                $('#approve_order_signature').iCheck('check');
                $('#approve_order_reject').iCheck('check');
            }
        }else{
            $('#approve_request').iCheck('uncheck');
            $('#approve_request_view').iCheck('uncheck');
            $('#approve_request_signature').iCheck('uncheck');
            $('#approve_request_reject').iCheck('uncheck');
			
			$('#approve_order').iCheck('uncheck');
            $('#approve_order_view').iCheck('uncheck');
            $('#approve_order_signature').iCheck('uncheck');
            $('#approve_order_reject').iCheck('uncheck');
        }
    });
	
	$('#user_control').on('ifChanged',function(){
        if (this.checked) {
            if ($('#department').prop('checked')==true
			|| $('#department_add').prop('checked')==true
			|| $('#department_edit').prop('checked')==true
			|| $('#department_delete').prop('checked')==true
			|| $('#department_download').prop('checked')==true
			|| $('#department_upload').prop('checked')==true
			
			|| $('#user').prop('checked')==true
			|| $('#user_add').prop('checked')==true
			|| $('#user_edit').prop('checked')==true
			|| $('#user_delete').prop('checked')==true
			|| $('#user_reset').prop('checked')==true
			
			|| $('#user_group').prop('checked')==true
			|| $('#user_group_add').prop('checked')==true
			|| $('#user_group_edit').prop('checked')==true
			|| $('#user_group_delete').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_upload').prop('checked')==true
			|| $('#user_group_assign').prop('checked')==true
			
			|| $('#role').prop('checked')==true
			|| $('#role_add').prop('checked')==true
			|| $('#role_edit').prop('checked')==true
			|| $('#role_delete').prop('checked')==true
			|| $('#role_assign').prop('checked')==true) {}else{
				
                $('#department').iCheck('check');
                $('#department_add').iCheck('check');
                $('#department_edit').iCheck('check');
                $('#department_delete').iCheck('check');
                $('#department_download').iCheck('check');
                $('#department_upload').iCheck('check');
				
				$('#user').iCheck('check');
                $('#user_add').iCheck('check');
                $('#user_edit').iCheck('check');
                $('#user_delete').iCheck('check');
                $('#user_reset').iCheck('check');
				
				$('#user_group').iCheck('check');
                $('#user_group_add').iCheck('check');
                $('#user_group_edit').iCheck('check');
                $('#user_group_delete').iCheck('check');
                $('#user_group_download').iCheck('check');
                $('#user_group_upload').iCheck('check');
                $('#user_group_assign').iCheck('check');
				
				$('#role').iCheck('check');
                $('#role_add').iCheck('check');
                $('#role_edit').iCheck('check');
                $('#role_delete').iCheck('check');
                $('#role_assign').iCheck('check');
            }
        }else{
			$('#department').iCheck('uncheck');
			$('#department_add').iCheck('uncheck');
			$('#department_edit').iCheck('uncheck');
			$('#department_delete').iCheck('uncheck');
			$('#department_download').iCheck('uncheck');
			$('#department_upload').iCheck('uncheck');
			
			$('#user').iCheck('uncheck');
			$('#user_add').iCheck('uncheck');
			$('#user_edit').iCheck('uncheck');
			$('#user_delete').iCheck('uncheck');
			$('#user_reset').iCheck('uncheck');
			
			$('#user_group').iCheck('uncheck');
			$('#user_group_add').iCheck('uncheck');
			$('#user_group_edit').iCheck('uncheck');
			$('#user_group_delete').iCheck('uncheck');
			$('#user_group_download').iCheck('uncheck');
			$('#user_group_upload').iCheck('uncheck');
			$('#user_group_assign').iCheck('uncheck');
			
			$('#role').iCheck('uncheck');
			$('#role_add').iCheck('uncheck');
			$('#role_edit').iCheck('uncheck');
			$('#role_delete').iCheck('uncheck');
			$('#role_assign').iCheck('uncheck');
        }
    });
	
	$('#system').on('ifChanged',function(){
        if (this.checked) {
            if ($('#setting').prop('checked')==true
			|| $('#user_log').prop('checked')==true
			
			|| $('#backup').prop('checked')==true
			|| $('#backup_add').prop('checked')==true
			|| $('#backup_download').prop('checked')==true
			|| $('#backup_delete').prop('checked')==true
			
			|| $('#trash').prop('checked')==true
			|| $('#trash_stock_entry').prop('checked')==true
			|| $('#trash_stock_import').prop('checked')==true
			|| $('#trash_stock_adjust').prop('checked')==true
			|| $('#trash_stock_move').prop('checked')==true
			|| $('#trash_stock_delivery').prop('checked')==true
			|| $('#trash_stock_return_delivery').prop('checked')==true
			|| $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {}else{
				
                $('#setting').iCheck('check');
                $('#user_log').iCheck('check');
				
                $('#backup').iCheck('check');
                $('#backup_add').iCheck('check');
                $('#backup_delete').iCheck('check');
                $('#backup_download').iCheck('check');
				
				$('#trash').iCheck('check');
                $('#trash_stock_entry').iCheck('check');
                $('#trash_stock_import').iCheck('check');
                $('#trash_stock_adjust').iCheck('check');
                $('#trash_stock_move').iCheck('check');
				$('#trash_stock_delivery').iCheck('check');
                $('#trash_stock_return_delivery').iCheck('check');
                $('#trash_stock_usage').iCheck('check');
                $('#trash_stock_return_usage').iCheck('check');
                $('#trash_request').iCheck('check');
                $('#trash_order').iCheck('check');
            }
        }else{
			$('#setting').iCheck('uncheck');
			$('#user_log').iCheck('uncheck');
			
			$('#backup').iCheck('uncheck');
			$('#backup_add').iCheck('uncheck');
			$('#backup_delete').iCheck('uncheck');
			$('#backup_download').iCheck('uncheck');
			
			$('#trash').iCheck('uncheck');
			$('#trash_stock_entry').iCheck('uncheck');
			$('#trash_stock_import').iCheck('uncheck');
			$('#trash_stock_adjust').iCheck('uncheck');
			$('#trash_stock_move').iCheck('uncheck');
			$('#trash_stock_delivery').iCheck('uncheck');
			$('#trash_stock_return_delivery').iCheck('uncheck');
			$('#trash_stock_usage').iCheck('uncheck');
            $('#trash_stock_return_usage').iCheck('uncheck');
            $('#trash_request').iCheck('uncheck');
			$('#trash_order').iCheck('uncheck');
        }
    });
	
	$('#inventory').on('ifChanged',function(){
        if (this.checked) {
            if($('#stock_entry').prop('checked')==true
			|| $('#stock_entry_add').prop('checked')==true
			|| $('#stock_entry_edit').prop('checked')==true
			|| $('#stock_entry_delete').prop('checked')==true
			
			|| $('#stock_import').prop('checked')==true
			|| $('#stock_import_download_sample').prop('checked')==true
			|| $('#stock_import_upload').prop('checked')==true
			|| $('#stock_import_delete').prop('checked')==true
			
			|| $('#stock_adjust').prop('checked')==true
			|| $('#stock_adjust_add').prop('checked')==true
			|| $('#stock_adjust_edit').prop('checked')==true
			|| $('#stock_adjust_delete').prop('checked')==true
			
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_move_add').prop('checked')==true
			|| $('#stock_move_edit').prop('checked')==true
			|| $('#stock_move_delete').prop('checked')==true
			
			|| $('#delivery').prop('checked')==true
			|| $('#delivery_entry').prop('checked')==true
			|| $('#delivery_entry_add').prop('checked')==true
			|| $('#delivery_entry_edit').prop('checked')==true
			|| $('#delivery_entry_delete').prop('checked')==true
			|| $('#delivery_return').prop('checked')==true
			|| $('#delivery_return_add').prop('checked')==true
			|| $('#delivery_return_edit').prop('checked')==true
			|| $('#delivery_return_delete').prop('checked')==true
			
			|| $('#stock_balance').prop('checked')==true
			|| $('#stock_balance_view').prop('checked')==true
			
			|| $('#usage').prop('checked')==true
			|| $('#usage_entry').prop('checked')==true
			|| $('#usage_entry_add').prop('checked')==true
			|| $('#usage_entry_edit').prop('checked')==true
			|| $('#usage_entry_delete').prop('checked')==true
			|| $('#usage_return').prop('checked')==true
			|| $('#usage_return_add').prop('checked')==true
			|| $('#usage_return_edit').prop('checked')==true
			|| $('#usage_return_delete').prop('checked')==true) {}else{
				
				$('#stock_entry').iCheck('check');
				$('#stock_entry_add').iCheck('check');
				$('#stock_entry_edit').iCheck('check');
				$('#stock_entry_delete').iCheck('check');
				
                $('#stock_import').iCheck('check');
                $('#stock_import_download_sample').iCheck('check');
                $('#stock_import_upload').iCheck('check');
                $('#stock_import_delete').iCheck('check');
				
                $('#stock_adjust').iCheck('check');
                $('#stock_adjust_add').iCheck('check');
                $('#stock_adjust_edit').iCheck('check');
                $('#stock_adjust_delete').iCheck('check');
				
                $('#stock_move').iCheck('check');
                $('#stock_move_add').iCheck('check');
                $('#stock_move_edit').iCheck('check');
                $('#stock_move_delete').iCheck('check');
				
				$('#stock_balance').iCheck('check');
                $('#stock_balance_view').iCheck('check');
				
				$('#delivery').iCheck('check');
				$('#delivery_entry').iCheck('check');
				$('#delivery_entry_add').iCheck('check');
				$('#delivery_entry_edit').iCheck('check');
				$('#delivery_entry_delete').iCheck('check');
				$('#delivery_return').iCheck('check');
				$('#delivery_return_add').iCheck('check');
				$('#delivery_return_edit').iCheck('check');
				$('#delivery_return_delete').iCheck('check');
				
                $('#usage').iCheck('check');
                $('#usage_entry').iCheck('check');
                $('#usage_entry_add').iCheck('check');
                $('#usage_entry_edit').iCheck('check');
                $('#usage_entry_delete').iCheck('check');
                $('#usage_return').iCheck('check');
                $('#usage_return_add').iCheck('check');
                $('#usage_return_edit').iCheck('check');
                $('#usage_return_delete').iCheck('check');
            }
        }else{
			
			$('#stock_entry').iCheck('uncheck');
				$('#stock_entry_add').iCheck('uncheck');
				$('#stock_entry_edit').iCheck('uncheck');
				$('#stock_entry_delete').iCheck('uncheck');
				
                $('#stock_import').iCheck('uncheck');
                $('#stock_import_download_sample').iCheck('uncheck');
                $('#stock_import_upload').iCheck('uncheck');
                $('#stock_import_delete').iCheck('uncheck');
				
                $('#stock_adjust').iCheck('uncheck');
                $('#stock_adjust_add').iCheck('uncheck');
                $('#stock_adjust_edit').iCheck('uncheck');
                $('#stock_adjust_delete').iCheck('uncheck');
				
                $('#stock_move').iCheck('uncheck');
                $('#stock_move_add').iCheck('uncheck');
                $('#stock_move_edit').iCheck('uncheck');
                $('#stock_move_delete').iCheck('uncheck');
				
				$('#stock_balance').iCheck('uncheck');
                $('#stock_balance_view').iCheck('uncheck');
				
				$('#delivery').iCheck('uncheck');
				$('#delivery_entry').iCheck('uncheck');
				$('#delivery_entry_add').iCheck('uncheck');
				$('#delivery_entry_edit').iCheck('uncheck');
				$('#delivery_entry_delete').iCheck('uncheck');
				$('#delivery_return').iCheck('uncheck');
				$('#delivery_return_add').iCheck('uncheck');
				$('#delivery_return_edit').iCheck('uncheck');
				$('#delivery_return_delete').iCheck('uncheck');
				
                $('#usage').iCheck('uncheck');
                $('#usage_entry').iCheck('uncheck');
                $('#usage_entry_add').iCheck('uncheck');
                $('#usage_entry_edit').iCheck('uncheck');
                $('#usage_entry_delete').iCheck('uncheck');
                $('#usage_return').iCheck('uncheck');
                $('#usage_return_add').iCheck('uncheck');
                $('#usage_return_edit').iCheck('uncheck');
                $('#usage_return_delete').iCheck('uncheck');
        }
    });
	
	$('#delivery').on('ifChanged',function(){
        if (this.checked) {
            if($('#delivery_entry').prop('checked')==true
			|| $('#delivery_entry_add').prop('checked')==true
			|| $('#delivery_entry_edit').prop('checked')==true
			|| $('#delivery_entry_delete').prop('checked')==true
			
			|| $('#delivery_return').prop('checked')==true
			|| $('#delivery_return_add').prop('checked')==true
			|| $('#delivery_return_edit').prop('checked')==true
			|| $('#delivery_return_delete').prop('checked')==true) {}else{
				
                $('#delivery_entry').iCheck('check');
                $('#delivery_entry_add').iCheck('check');
                $('#delivery_entry_edit').iCheck('check');
                $('#delivery_entry_delete').iCheck('check');
				
				$('#delivery_return').iCheck('check');
                $('#delivery_return_add').iCheck('check');
                $('#delivery_return_edit').iCheck('check');
                $('#delivery_return_delete').iCheck('check');
            }
        }else{
            $('#delivery_entry').iCheck('uncheck');
            $('#delivery_entry_add').iCheck('uncheck');
            $('#delivery_entry_edit').iCheck('uncheck');
            $('#delivery_entry_delete').iCheck('uncheck');
			
			$('#delivery_return').iCheck('uncheck');
            $('#delivery_return_add').iCheck('uncheck');
            $('#delivery_return_edit').iCheck('uncheck');
            $('#delivery_return_delete').iCheck('uncheck');
        }
    });
	
	$('#usage').on('ifChanged',function(){
        if (this.checked) {
            if($('#usage_entry').prop('checked')==true
			|| $('#usage_entry_add').prop('checked')==true
			|| $('#usage_entry_edit').prop('checked')==true
			|| $('#usage_entry_delete').prop('checked')==true
			
			|| $('#usage_return').prop('checked')==true
			|| $('#usage_return_add').prop('checked')==true
			|| $('#usage_return_edit').prop('checked')==true
			|| $('#usage_return_delete').prop('checked')==true) {}else{
				
                $('#usage_entry').iCheck('check');
                $('#usage_entry_add').iCheck('check');
                $('#usage_entry_edit').iCheck('check');
                $('#usage_entry_delete').iCheck('check');
				
				$('#usage_return').iCheck('check');
                $('#usage_return_add').iCheck('check');
                $('#usage_return_edit').iCheck('check');
                $('#usage_return_delete').iCheck('check');
            }
        }else{
            $('#usage_entry').iCheck('uncheck');
            $('#usage_entry_add').iCheck('uncheck');
            $('#usage_entry_edit').iCheck('uncheck');
            $('#usage_entry_delete').iCheck('uncheck');
			
			$('#usage_return').iCheck('uncheck');
            $('#usage_return_add').iCheck('uncheck');
            $('#usage_return_edit').iCheck('uncheck');
            $('#usage_return_delete').iCheck('uncheck');
        }
    });

    $('#report').on('ifChanged',function(){
        if (this.checked) {
            if($('#report_boq').prop('checked')==true
            || $('#report_boq_detail').prop('checked')==true
            || $('#report_sub_boq').prop('checked')==true
            
            || $('#report_usage').prop('checked')==true
            || $('#report_usage_entry').prop('checked')==true
            || $('#report_return_usage').prop('checked')==true
            
            || $('#report_purchase').prop('checked')==true
            || $('#report_purchase_request').prop('checked')==true
            || $('#report_purchase_request_1').prop('checked')==true
            || $('#report_purchase_request_2').prop('checked')==true
            || $('#report_purchase_request_3').prop('checked')==true
            
            || $('#report_purchase_order').prop('checked')==true
            || $('#report_purchase_order_1').prop('checked')==true
            || $('#report_purchase_order_2').prop('checked')==true
            || $('#report_purchase_order_3').prop('checked')==true
            
            || $('#report_delivery').prop('checked')==true
            || $('#report_delivery_item').prop('checked')==true
            || $('#report_return_delivery_item').prop('checked')==true

            || $('#report_stock').prop('checked')==true
            || $('#report_stock_balance').prop('checked')==true
            || $('#report_all_stock').prop('checked')==true) {}else{

                $('#report_boq').iCheck('check');
                $('#report_boq_detail').iCheck('check');
                $('#report_sub_boq').iCheck('check');
                
                $('#report_usage').iCheck('check');
                $('#report_usage_entry').iCheck('check');
                $('#report_return_usage').iCheck('check');
                
                $('#report_purchase').iCheck('check');
                $('#report_purchase_request').iCheck('check');
                $('#report_purchase_request_1').iCheck('check');
                $('#report_purchase_request_2').iCheck('check');
                $('#report_purchase_request_3').iCheck('check');
                
                $('#report_purchase_order').iCheck('check');
                $('#report_purchase_order_1').iCheck('check');
                $('#report_purchase_order_2').iCheck('check');
                $('#report_purchase_order_3').iCheck('check');
                
                $('#report_delivery').iCheck('check');
                $('#report_delivery_item').iCheck('check');
                $('#report_return_delivery_item').iCheck('check');

                $('#report_stock').iCheck('check');
                $('#report_stock_balance').iCheck('check');
                $('#report_all_stock').iCheck('check');
            }
        }else{

            $('#report_boq').iCheck('uncheck');
            $('#report_boq_detail').iCheck('uncheck');
            $('#report_sub_boq').iCheck('uncheck');
            
            $('#report_usage').iCheck('uncheck');
            $('#report_usage_entry').iCheck('uncheck');
            $('#report_return_usage').iCheck('uncheck');
            
            $('#report_purchase').iCheck('uncheck');
            $('#report_purchase_request').iCheck('uncheck');
            $('#report_purchase_request_1').iCheck('uncheck');
            $('#report_purchase_request_2').iCheck('uncheck');
            $('#report_purchase_request_3').iCheck('uncheck');
            
            $('#report_purchase_order').iCheck('uncheck');
            $('#report_purchase_order_1').iCheck('uncheck');
            $('#report_purchase_order_2').iCheck('uncheck');
            $('#report_purchase_order_3').iCheck('uncheck');
            
            $('#report_delivery').iCheck('uncheck');
            $('#report_delivery_item').iCheck('uncheck');
            $('#report_return_delivery_item').iCheck('uncheck');

            $('#report_stock').iCheck('uncheck');
            $('#report_stock_balance').iCheck('uncheck');
            $('#report_all_stock').iCheck('uncheck');
        }
    });
	
	// ======================== End Parent Note ====================== //
	
    $('#report_boq').on('ifChanged',function(){
        if (this.checked) {
            $('#report').iCheck('check');
        }else{
            if ($('#report_usage').prop('checked')==true
            || $('#report_purchase').prop('checked')==true
            || $('#report_stock').prop('checked')==true) {
                $('#report').iCheck('check');
            }else{
                $('#report').iCheck('uncheck');
            }
        }
    });

    $('#report_usage').on('ifChanged',function(){
        if (this.checked) {
            $('#report').iCheck('check');
        }else{
            if ($('#report_boq').prop('checked')==true
            || $('#report_purchase').prop('checked')==true
            || $('#report_stock').prop('checked')==true) {
                $('#report').iCheck('check');
            }else{
                $('#report').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase').on('ifChanged',function(){
        if (this.checked) {
            $('#report').iCheck('check');
        }else{
            if ($('#report_usage').prop('checked')==true
            || $('#report_boq').prop('checked')==true
            || $('#report_stock').prop('checked')==true) {
                $('#report').iCheck('check');
            }else{
                $('#report').iCheck('uncheck');
            }
        }
    });

    $('#report_stock').on('ifChanged',function(){
        if (this.checked) {
            $('#report').iCheck('check');
        }else{
            if ($('#report_usage').prop('checked')==true
            || $('#report_purchase').prop('checked')==true
            || $('#report_boq').prop('checked')==true) {
                $('#report').iCheck('check');
            }else{
                $('#report').iCheck('uncheck');
            }
        }
    });

    $('#report_boq').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_boq_detail').prop('checked')==true
            || $('#report_sub_boq').prop('checked')==true) {}else{
                $('#report_boq_detail').iCheck('check');
                $('#report_sub_boq').iCheck('check');
            }
        }else{
            $('#report_boq_detail').iCheck('uncheck');
            $('#report_sub_boq').iCheck('uncheck');
        }
    });

    $('#report_usage').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_usage_entry').prop('checked')==true
            || $('#report_return_usage').prop('checked')==true) {}else{
                $('#report_usage_entry').iCheck('check');
                $('#report_return_usage').iCheck('check');
            }
        }else{
            $('#report_usage_entry').iCheck('uncheck');
            $('#report_return_usage').iCheck('uncheck');
        }
    });

    $('#report_purchase').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_purchase_request').prop('checked')==true
            || $('#report_purchase_order').prop('checked')==true
            || $('#report_delivery').prop('checked')==true) {}else{
                $('#report_purchase_request').iCheck('check');
                $('#report_purchase_order').iCheck('check');
                $('#report_delivery').iCheck('check');
            }
        }else{
            $('#report_purchase_request').iCheck('uncheck');
            $('#report_purchase_order').iCheck('uncheck');
            $('#report_delivery').iCheck('uncheck');
        }
    });

    $('#report_stock').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_stock_balance').prop('checked')==true
            || $('#report_all_stock').prop('checked')==true) {}else{
                $('#report_stock_balance').iCheck('check');
                $('#report_all_stock').iCheck('check');
            }
        }else{
            $('#report_stock_balance').iCheck('uncheck');
            $('#report_all_stock').iCheck('uncheck');
        }
    });

    $('#report_boq_detail').on('ifChanged',function(){
        if (this.checked) {
            $('#report_boq').iCheck('check');
        }else{
            if ($('#report_sub_boq').prop('checked')==true) {
                $('#report_boq').iCheck('check');
            }else{
                $('#report_boq').iCheck('uncheck');
            }
        }
    });

    $('#report_sub_boq').on('ifChanged',function(){
        if (this.checked) {
            $('#report_boq').iCheck('check');
        }else{
            if ($('#report_boq_detail').prop('checked')==true) {
                $('#report_boq').iCheck('check');
            }else{
                $('#report_boq').iCheck('uncheck');
            }
        }
    });

    $('#report_usage_entry').on('ifChanged',function(){
        if (this.checked) {
            $('#report_usage').iCheck('check');
        }else{
            if ($('#report_return_usage').prop('checked')==true) {
                $('#report_usage').iCheck('check');
            }else{
                $('#report_usage').iCheck('uncheck');
            }
        }
    });
    
    $('#report_return_usage').on('ifChanged',function(){
        if (this.checked) {
            $('#report_usage').iCheck('check');
        }else{
            if ($('#report_usage_entry').prop('checked')==true) {
                $('#report_usage').iCheck('check');
            }else{
                $('#report_usage').iCheck('uncheck');
            }
        }
    });

    $('#report_stock_balance').on('ifChanged',function(){
        if (this.checked) {
            $('#report_stock').iCheck('check');
        }else{
            if ($('#report_all_stock').prop('checked')==true) {
                $('#report_stock').iCheck('check');
            }else{
                $('#report_stock').iCheck('uncheck');
            }
        }
    });
    
    $('#report_all_stock').on('ifChanged',function(){
        if (this.checked) {
            $('#report_stock').iCheck('check');
        }else{
            if ($('#report_stock_balance').prop('checked')==true) {
                $('#report_stock').iCheck('check');
            }else{
                $('#report_stock').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_request').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase').iCheck('check');
        }else{
            if ($('#report_purchase_order').prop('checked')==true
             || $('#report_delivery').prop('checked')==true) {
                $('#report_purchase').iCheck('check');
            }else{
                $('#report_purchase').iCheck('uncheck');
            }
        }
    });
    
    $('#report_purchase_order').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase').iCheck('check');
        }else{
            if ($('#report_purchase_request').prop('checked')==true
             || $('#report_delivery').prop('checked')==true) {
                $('#report_purchase').iCheck('check');
            }else{
                $('#report_purchase').iCheck('uncheck');
            }
        }
    });

    $('#report_delivery').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase').iCheck('check');
        }else{
            if ($('#report_purchase_request').prop('checked')==true
             || $('#report_purchase_order').prop('checked')==true) {
                $('#report_purchase').iCheck('check');
            }else{
                $('#report_purchase').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_request').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_purchase_request_1').prop('checked')==true
            || $('#report_purchase_request_2').prop('checked')==true
            || $('#report_purchase_request_3').prop('checked')==true) {}else{
                $('#report_purchase_request_1').iCheck('check');
                $('#report_purchase_request_2').iCheck('check');
                $('#report_purchase_request_3').iCheck('check');
            }
        }else{
            $('#report_purchase_request_1').iCheck('uncheck');
            $('#report_purchase_request_2').iCheck('uncheck');
            $('#report_purchase_request_3').iCheck('uncheck');
        }
    });

    $('#report_purchase_order').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_purchase_order_1').prop('checked')==true
            || $('#report_purchase_order_2').prop('checked')==true
            || $('#report_purchase_order_3').prop('checked')==true) {}else{
                $('#report_purchase_order_1').iCheck('check');
                $('#report_purchase_order_2').iCheck('check');
                $('#report_purchase_order_3').iCheck('check');
            }
        }else{
            $('#report_purchase_order_1').iCheck('uncheck');
            $('#report_purchase_order_2').iCheck('uncheck');
            $('#report_purchase_order_3').iCheck('uncheck');
        }
    });

    $('#report_delivery').on('ifChanged',function(){
        if (this.checked) {
            if ($('#report_delivery_item').prop('checked')==true
            || $('#report_return_delivery_item').prop('checked')==true) {}else{
                $('#report_delivery_item').iCheck('check');
                $('#report_return_delivery_item').iCheck('check');
            }
        }else{
            $('#report_delivery_item').iCheck('uncheck');
            $('#report_return_delivery_item').iCheck('uncheck');
        }
    });

    $('#report_purchase_request_1').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase_request').iCheck('check');
        }else{
            if ($('#report_purchase_request_2').prop('checked')==true
             || $('#report_purchase_request_3').prop('checked')==true) {
                $('#report_purchase_request').iCheck('check');
            }else{
                $('#report_purchase_request').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_request_2').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase_request').iCheck('check');
        }else{
            if ($('#report_purchase_request_1').prop('checked')==true
             || $('#report_purchase_request_3').prop('checked')==true) {
                $('#report_purchase_request').iCheck('check');
            }else{
                $('#report_purchase_request').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_request_3').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase_request').iCheck('check');
        }else{
            if ($('#report_purchase_request_2').prop('checked')==true
             || $('#report_purchase_request_1').prop('checked')==true) {
                $('#report_purchase_request').iCheck('check');
            }else{
                $('#report_purchase_request').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_order_1').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase_order').iCheck('check');
        }else{
            if ($('#report_purchase_order_2').prop('checked')==true
             || $('#report_purchase_order_3').prop('checked')==true) {
                $('#report_purchase_order').iCheck('check');
            }else{
                $('#report_purchase_order').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_order_2').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase_order').iCheck('check');
        }else{
            if ($('#report_purchase_order_1').prop('checked')==true
             || $('#report_purchase_order_3').prop('checked')==true) {
                $('#report_purchase_order').iCheck('check');
            }else{
                $('#report_purchase_order').iCheck('uncheck');
            }
        }
    });

    $('#report_purchase_order_3').on('ifChanged',function(){
        if (this.checked) {
            $('#report_purchase_order').iCheck('check');
        }else{
            if ($('#report_purchase_order_2').prop('checked')==true
             || $('#report_purchase_order_1').prop('checked')==true) {
                $('#report_purchase_order').iCheck('check');
            }else{
                $('#report_purchase_order').iCheck('uncheck');
            }
        }
    });

    $('#report_delivery_item').on('ifChanged',function(){
        if (this.checked) {
            $('#report_delivery').iCheck('check');
        }else{
            if ($('#report_return_delivery_item').prop('checked')==true) {
                $('#report_delivery').iCheck('check');
            }else{
                $('#report_delivery').iCheck('uncheck');
            }
        }
    });

    $('#report_return_delivery_item').on('ifChanged',function(){
        if (this.checked) {
            $('#report_delivery').iCheck('check');
        }else{
            if ($('#report_delivery_item').prop('checked')==true) {
                $('#report_delivery').iCheck('check');
            }else{
                $('#report_delivery').iCheck('uncheck');
            }
        }
    });

    // ========================= End Report ========================== //

	$('#dash-request').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-order').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-delivery').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-usage').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-chart-house-type').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-usage').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-chart-request-item').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-chart-order-item').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-order-price').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });

    $('#dash-chart-order-price').on('ifChanged',function(){
        if (this.checked) {
            $('#dashboard').iCheck('check');
        }else{
            if ($('#dash-request').prop('checked')==true
            || $('#dash-order').prop('checked')==true
            || $('#dash-delivery').prop('checked')==true
            || $('#dash-chart-request-item').prop('checked')==true
            || $('#dash-chart-order-item').prop('checked')==true
            || $('#dash-usage').prop('checked')==true
            || $('#dash-chart-house-type').prop('checked')==true) {
                $('#dashboard').iCheck('check');
            }else{
                $('#dashboard').iCheck('uncheck');
            }
        }
    });
	
	// =========================== End Dashboard ============================ //

    $('#zone').on('ifChanged',function(){
        if (this.checked) {
            $('#setup_option').iCheck('check');
        }else{
            if ($('#block').prop('checked')==true 
			|| $('#street').prop('checked')==true 
			|| $('#constructor').prop('checked')==true 
			|| $('#warehouse').prop('checked')==true) {
                $('#setup_option').iCheck('check');
            }else{
                $('#setup_option').iCheck('uncheck'); 
            }
        }
    });

    $('#block').on('ifChanged',function(){
        if (this.checked) {
            $('#setup_option').iCheck('check');
        }else{
            if ($('#zone').prop('checked')==true 
			|| $('#street').prop('checked')==true 
			|| $('#constructor').prop('checked')==true 
			|| $('#warehouse').prop('checked')==true) {
                $('#setup_option').iCheck('check');
            }else{
                $('#setup_option').iCheck('uncheck'); 
            }
        }
    });

    $('#street').on('ifChanged',function(){
        if (this.checked) {
            $('#setup_option').iCheck('check');
        }else{
            if ($('#block').prop('checked')==true 
			|| $('#zone').prop('checked')==true 
			|| $('#constructor').prop('checked')==true 
			|| $('#warehouse').prop('checked')==true) {
                $('#setup_option').iCheck('check');
            }else{
                $('#setup_option').iCheck('uncheck'); 
            }
        }
    });
	
	$('#constructor').on('ifChanged',function(){
        if (this.checked) {
            $('#setup_option').iCheck('check');
        }else{
            if ($('#block').prop('checked')==true 
			|| $('#zone').prop('checked')==true 
			|| $('#street').prop('checked')==true 
			|| $('#warehouse').prop('checked')==true) {
                $('#setup_option').iCheck('check');
            }else{
                $('#setup_option').iCheck('uncheck'); 
            }
        }
    });
	
	$('#warehouse').on('ifChanged',function(){
        if (this.checked) {
            $('#setup_option').iCheck('check');
        }else{
            if ($('#block').prop('checked')==true 
			|| $('#zone').prop('checked')==true 
			|| $('#constructor').prop('checked')==true 
			|| $('#street').prop('checked')==true) {
                $('#setup_option').iCheck('check');
            }else{
                $('#setup_option').iCheck('uncheck'); 
            }
        }
    });
	
	$('#zone').on('ifChanged',function(){
        if (this.checked) {
            if ($('#zone_add').prop('checked')==true
            || $('#zone_edit').prop('checked')==true
            || $('#zone_delete').prop('checked')==true
            || $('#zone_download').prop('checked')==true
            || $('#zone_upload').prop('checked')==true) {}else{
                $('#zone_add').iCheck('check');
                $('#zone_edit').iCheck('check');
                $('#zone_delete').iCheck('check');
                $('#zone_download').iCheck('check');
                $('#zone_upload').iCheck('check');
            }
        }else{
            $('#zone_add').iCheck('uncheck');
            $('#zone_edit').iCheck('uncheck');
            $('#zone_delete').iCheck('uncheck');
            $('#zone_download').iCheck('uncheck');
            $('#zone_upload').iCheck('uncheck');
        }
    });

    $('#block').on('ifChanged',function(){
        if (this.checked) {
            if ($('#block_add').prop('checked')==true
            || $('#block_edit').prop('checked')==true
            || $('#block_delete').prop('checked')==true
            || $('#block_download').prop('checked')==true
            || $('#block_upload').prop('checked')==true) {}else{
                $('#block_add').iCheck('check');
                $('#block_edit').iCheck('check');
                $('#block_delete').iCheck('check');
                $('#block_download').iCheck('check');
                $('#block_upload').iCheck('check');
            }
        }else{
            $('#block_add').iCheck('uncheck');
            $('#block_edit').iCheck('uncheck');
            $('#block_delete').iCheck('uncheck');
            $('#block_download').iCheck('uncheck');
            $('#block_upload').iCheck('uncheck');
        }
    });

    $('#street').on('ifChanged',function(){
        if (this.checked) {
            if ($('#street_add').prop('checked')==true
            || $('#street_edit').prop('checked')==true
            || $('#street_delete').prop('checked')==true
            || $('#setup_option-set-uom').prop('checked')==true
            || $('#setup_option-show-uom').prop('checked')==true
            || $('#street_download').prop('checked')==true
            || $('#street_upload').prop('checked')==true) {}else{
                $('#street_add').iCheck('check');
                $('#street_edit').iCheck('check');
                $('#street_delete').iCheck('check');
                $('#street_download').iCheck('check');
                $('#street_upload').iCheck('check');
            }
        }else{
            $('#street_add').iCheck('uncheck');
            $('#street_edit').iCheck('uncheck');
            $('#street_delete').iCheck('uncheck');
            $('#setup_option-set-uom').iCheck('uncheck');
            $('#setup_option-show-uom').iCheck('uncheck');
            $('#street_download').iCheck('uncheck');
            $('#street_upload').iCheck('uncheck');
        }
    });
	
	$('#constructor').on('ifChanged',function(){
        if (this.checked) {
            if ($('#constructor_add').prop('checked')==true
            || $('#constructor_edit').prop('checked')==true
            || $('#constructor_delete').prop('checked')==true
            || $('#constructor_download').prop('checked')==true
            || $('#constructor_upload').prop('checked')==true) {}else{
                $('#constructor_add').iCheck('check');
                $('#constructor_edit').iCheck('check');
                $('#constructor_delete').iCheck('check');
                $('#constructor_download').iCheck('check');
                $('#constructor_upload').iCheck('check');
            }
        }else{
            $('#constructor_add').iCheck('uncheck');
            $('#constructor_edit').iCheck('uncheck');
            $('#constructor_delete').iCheck('uncheck');
            $('#constructor_download').iCheck('uncheck');
            $('#constructor_upload').iCheck('uncheck');
        }
    });
	
	$('#warehouse').on('ifChanged',function(){
        if (this.checked) {
            if ($('#warehouse_add').prop('checked')==true
            || $('#warehouse_edit').prop('checked')==true
            || $('#warehouse_delete').prop('checked')==true
            || $('#warehouse_download').prop('checked')==true
            || $('#warehouse_upload').prop('checked')==true) {}else{
                $('#warehouse_add').iCheck('check');
                $('#warehouse_edit').iCheck('check');
                $('#warehouse_delete').iCheck('check');
                $('#warehouse_download').iCheck('check');
                $('#warehouse_upload').iCheck('check');
            }
        }else{
            $('#warehouse_add').iCheck('uncheck');
            $('#warehouse_edit').iCheck('uncheck');
            $('#warehouse_delete').iCheck('uncheck');
            $('#warehouse_download').iCheck('uncheck');
            $('#warehouse_upload').iCheck('uncheck');
        }
    });

    $('#zone_add').on('ifChanged',function(){
        if (this.checked) {
            $('#zone').iCheck('check');
        }else{
            if ($('#zone_edit').prop('checked')==true
            || $('#zone_delete').prop('checked')==true
            || $('#zone_download').prop('checked')==true
            || $('#zone_upload').prop('checked')==true) {
                $('#zone').iCheck('check');
            }else{
                $('#zone').iCheck('uncheck');
            }
        }
    });

    $('#zone_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#zone').iCheck('check');
        }else{
            if ($('#zone_add').prop('checked')==true
            || $('#zone_delete').prop('checked')==true
            || $('#zone_download').prop('checked')==true
            || $('#zone_upload').prop('checked')==true) {
                $('#zone').iCheck('check');
            }else{
                $('#zone').iCheck('uncheck');
            }
        }
    });

    $('#zone_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#zone').iCheck('check');
        }else{
            if ($('#zone_add').prop('checked')==true
            || $('#zone_edit').prop('checked')==true
            || $('#zone_download').prop('checked')==true
            || $('#zone_upload').prop('checked')==true) {
                $('#zone').iCheck('check');
            }else{
                $('#zone').iCheck('uncheck');
            }
        }
    });

    $('#zone_download').on('ifChanged',function(){
        if (this.checked) {
            $('#zone').iCheck('check');
        }else{
            if ($('#zone_add').prop('checked')==true
            || $('#zone_edit').prop('checked')==true
            || $('#zone_delete').prop('checked')==true
            || $('#zone_upload').prop('checked')==true) {
                $('#zone').iCheck('check');
            }else{
                $('#zone').iCheck('uncheck');
            }
        }
    });

    $('#zone_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#zone').iCheck('check');
        }else{
            if ($('#zone_add').prop('checked')==true
            || $('#zone_edit').prop('checked')==true
            || $('#zone_delete').prop('checked')==true
            || $('#zone_download').prop('checked')==true) {
                $('#zone').iCheck('check');
            }else{
                $('#zone').iCheck('uncheck');
            }
        }
    });

    $('#block_add').on('ifChanged',function(){
        if (this.checked) {
            $('#block').iCheck('check');
        }else{
            if ($('#block_upload').prop('checked')==true
            || $('#block_edit').prop('checked')==true
            || $('#block_delete').prop('checked')==true
            || $('#block_download').prop('checked')==true) {
                $('#block').iCheck('check');
            }else{
                $('#block').iCheck('uncheck');
            }
        }
    });

    $('#block_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#block').iCheck('check');
        }else{
            if ($('#block_upload').prop('checked')==true
            || $('#block_add').prop('checked')==true
            || $('#block_delete').prop('checked')==true
            || $('#block_download').prop('checked')==true) {
                $('#block').iCheck('check');
            }else{
                $('#block').iCheck('uncheck');
            }
        }
    });

    $('#block_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#block').iCheck('check');
        }else{
            if ($('#block_upload').prop('checked')==true
            || $('#block_add').prop('checked')==true
            || $('#block_edit').prop('checked')==true
            || $('#block_download').prop('checked')==true) {
                $('#block').iCheck('check');
            }else{
                $('#block').iCheck('uncheck');
            }
        }
    });

    $('#block_download').on('ifChanged',function(){
        if (this.checked) {
            $('#block').iCheck('check');
        }else{
            if ($('#block_delete').prop('checked')==true
            || $('#block_add').prop('checked')==true
            || $('#block_edit').prop('checked')==true
            || $('#block_upload').prop('checked')==true) {
                $('#block').iCheck('check');
            }else{
                $('#block').iCheck('uncheck');
            }
        }
    });
	
	$('#block_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#block').iCheck('check');
        }else{
            if ($('#block_delete').prop('checked')==true
            || $('#block_add').prop('checked')==true
            || $('#block_edit').prop('checked')==true
            || $('#block_download').prop('checked')==true) {
                $('#block').iCheck('check');
            }else{
                $('#block').iCheck('uncheck');
            }
        }
    });

    $('#street_add').on('ifChanged',function(){
        if (this.checked) {
            $('#street').iCheck('check');
        }else{
            if ($('#street_edit').prop('checked')==true
            || $('#street_delete').prop('checked')==true
            || $('#street_download').prop('checked')==true
            || $('#street_upload').prop('checked')==true) {
                $('#street').iCheck('check');
            }else{
                $('#street').iCheck('uncheck');
            }
        }
    });

    $('#street_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#street').iCheck('check');
        }else{
            if ($('#street_add').prop('checked')==true
            || $('#street_delete').prop('checked')==true
            || $('#street_download').prop('checked')==true
            || $('#street_upload').prop('checked')==true) {
                $('#street').iCheck('check');
            }else{
                $('#street').iCheck('uncheck');
            }
        }
    });

    $('#street_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#street').iCheck('check');
        }else{
            if ($('#street_add').prop('checked')==true
            || $('#street_edit').prop('checked')==true
            || $('#street_download').prop('checked')==true
            || $('#street_upload').prop('checked')==true) {
                $('#street').iCheck('check');
            }else{
                $('#street').iCheck('uncheck');
            }
        }
    });

    $('#street_download').on('ifChanged',function(){
        if (this.checked) {
            $('#street').iCheck('check');
        }else{
            if ($('#street_add').prop('checked')==true
            || $('#street_edit').prop('checked')==true
            || $('#street_delete').prop('checked')==true
            || $('#setup_option-set-uom').prop('checked')==true
            || $('#setup_option-show-uom').prop('checked')==true
            || $('#street_upload').prop('checked')==true) {
                $('#street').iCheck('check');
            }else{
                $('#street').iCheck('uncheck');
            }
        }
    });

    $('#street_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#street').iCheck('check');
        }else{
            if ($('#street_add').prop('checked')==true
            || $('#street_edit').prop('checked')==true
            || $('#street_delete').prop('checked')==true
            || $('#street_download').prop('checked')==true) {
                $('#street').iCheck('check');
            }else{
                $('#street').iCheck('uncheck');
            }
        }
    });
	
	$('#constructor_add').on('ifChanged',function(){
        if (this.checked) {
            $('#constructor').iCheck('check');
        }else{
            if ($('#constructor_edit').prop('checked')==true
            || $('#constructor_delete').prop('checked')==true
            || $('#constructor_download').prop('checked')==true
            || $('#constructor_upload').prop('checked')==true) {
                $('#constructor').iCheck('check');
            }else{
                $('#constructor').iCheck('uncheck');
            }
        }
    });

    $('#constructor_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#constructor').iCheck('check');
        }else{
            if ($('#constructor_add').prop('checked')==true
            || $('#constructor_delete').prop('checked')==true
            || $('#constructor_download').prop('checked')==true
            || $('#constructor_upload').prop('checked')==true) {
                $('#constructor').iCheck('check');
            }else{
                $('#constructor').iCheck('uncheck');
            }
        }
    });

    $('#constructor_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#constructor').iCheck('check');
        }else{
            if ($('#constructor_add').prop('checked')==true
            || $('#constructor_edit').prop('checked')==true
            || $('#constructor_download').prop('checked')==true
            || $('#constructor_upload').prop('checked')==true) {
                $('#constructor').iCheck('check');
            }else{
                $('#constructor').iCheck('uncheck');
            }
        }
    });

    $('#constructor_download').on('ifChanged',function(){
        if (this.checked) {
            $('#constructor').iCheck('check');
        }else{
            if ($('#constructor_add').prop('checked')==true
            || $('#constructor_edit').prop('checked')==true
            || $('#constructor_delete').prop('checked')==true
            || $('#constructor_upload').prop('checked')==true) {
                $('#constructor').iCheck('check');
            }else{
                $('#constructor').iCheck('uncheck');
            }
        }
    });

    $('#constructor_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#constructor').iCheck('check');
        }else{
            if ($('#constructor_add').prop('checked')==true
            || $('#constructor_edit').prop('checked')==true
            || $('#constructor_delete').prop('checked')==true
            || $('#constructor_download').prop('checked')==true) {
                $('#constructor').iCheck('check');
            }else{
                $('#constructor').iCheck('uncheck');
            }
        }
    });

	
	$('#warehouse_add').on('ifChanged',function(){
        if (this.checked) {
            $('#warehouse').iCheck('check');
        }else{
            if ($('#warehouse_edit').prop('checked')==true
            || $('#warehouse_delete').prop('checked')==true
            || $('#warehouse_download').prop('checked')==true
            || $('#warehouse_upload').prop('checked')==true) {
                $('#warehouse').iCheck('check');
            }else{
                $('#warehouse').iCheck('uncheck');
            }
        }
    });

    $('#warehouse_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#warehouse').iCheck('check');
        }else{
            if ($('#warehouse_add').prop('checked')==true
            || $('#warehouse_delete').prop('checked')==true
            || $('#warehouse_download').prop('checked')==true
            || $('#warehouse_upload').prop('checked')==true) {
                $('#warehouse').iCheck('check');
            }else{
                $('#warehouse').iCheck('uncheck');
            }
        }
    });

    $('#warehouse_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#warehouse').iCheck('check');
        }else{
            if ($('#warehouse_add').prop('checked')==true
            || $('#warehouse_edit').prop('checked')==true
            || $('#warehouse_download').prop('checked')==true
            || $('#warehouse_upload').prop('checked')==true) {
                $('#warehouse').iCheck('check');
            }else{
                $('#warehouse').iCheck('uncheck');
            }
        }
    });

    $('#warehouse_download').on('ifChanged',function(){
        if (this.checked) {
            $('#warehouse').iCheck('check');
        }else{
            if ($('#warehouse_add').prop('checked')==true
            || $('#warehouse_edit').prop('checked')==true
            || $('#warehouse_delete').prop('checked')==true
            || $('#warehouse_option-set-uom').prop('checked')==true
            || $('#warehouse_option-show-uom').prop('checked')==true
            || $('#warehouse_upload').prop('checked')==true) {
                $('#warehouse').iCheck('check');
            }else{
                $('#warehouse').iCheck('uncheck');
            }
        }
    });

    $('#warehouse_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#warehouse').iCheck('check');
        }else{
            if ($('#warehouse_add').prop('checked')==true
            || $('#warehouse_edit').prop('checked')==true
            || $('#warehouse_delete').prop('checked')==true
            || $('#warehouse_download').prop('checked')==true) {
                $('#warehouse').iCheck('check');
            }else{
                $('#warehouse').iCheck('uncheck');
            }
        }
    });

	// ========================== End Setup Option =============================== //

    $('#item_type').on('ifChanged',function(){
        if (this.checked) {
            $('#item_info').iCheck('check');
        }else{
            if ($('#unit').prop('checked')==true 
			|| $('#item').prop('checked')==true 
			|| $('#supplier').prop('checked')==true 
			|| $('#supplier_item').prop('checked')==true) {
                $('#item_info').iCheck('check');
            }else{
                $('#item_info').iCheck('uncheck');
            }
        }
    });

    $('#unit').on('ifChanged',function(){
        if (this.checked) {
            $('#item_info').iCheck('check');
        }else{
            if ($('#item_type').prop('checked')==true 
			|| $('#item').prop('checked')==true 
			|| $('#supplier').prop('checked')==true 
			|| $('#supplier_item').prop('checked')==true) {
                $('#item_info').iCheck('check');
            }else{
                $('#item_info').iCheck('uncheck');
            }
        }
    });

    $('#item').on('ifChanged',function(){
        if (this.checked) {
            $('#item_info').iCheck('check');
        }else{
            if ($('#unit').prop('checked')==true 
			|| $('#item_type').prop('checked')==true 
			|| $('#supplier').prop('checked')==true 
			|| $('#supplier_item').prop('checked')==true) {
                $('#item_info').iCheck('check');
            }else{
                $('#item_info').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier').on('ifChanged',function(){
        if (this.checked) {
            $('#item_info').iCheck('check');
        }else{
            if ($('#unit').prop('checked')==true 
			|| $('#item_type').prop('checked')==true 
			|| $('#item').prop('checked')==true 
			|| $('#supplier_item').prop('checked')==true) {
                $('#item_info').iCheck('check');
            }else{
                $('#item_info').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier_item').on('ifChanged',function(){
        if (this.checked) {
            $('#item_info').iCheck('check');
        }else{
            if ($('#unit').prop('checked')==true 
			|| $('#item_type').prop('checked')==true 
			|| $('#supplier').prop('checked')==true 
			|| $('#item').prop('checked')==true) {
                $('#item_info').iCheck('check');
            }else{
                $('#item_info').iCheck('uncheck');
            }
        }
    });
	
	$('#item_type').on('ifChanged',function(){
        if (this.checked) {
            if ($('#item_type_add').prop('checked')==true
            || $('#item_type_edit').prop('checked')==true
            || $('#item_type_delete').prop('checked')==true
            || $('#item_type_download').prop('checked')==true
            || $('#item_type_upload').prop('checked')==true) {}else{
                $('#item_type_add').iCheck('check');
                $('#item_type_edit').iCheck('check');
                $('#item_type_delete').iCheck('check');
                $('#item_type_download').iCheck('check');
                $('#item_type_upload').iCheck('check');
            }
        }else{
            $('#item_type_add').iCheck('uncheck');
            $('#item_type_edit').iCheck('uncheck');
            $('#item_type_delete').iCheck('uncheck');
            $('#item_type_download').iCheck('uncheck');
            $('#item_type_upload').iCheck('uncheck');
        }
    });

    $('#unit').on('ifChanged',function(){
        if (this.checked) {
            if ($('#unit_add').prop('checked')==true
            || $('#unit_edit').prop('checked')==true
            || $('#unit_delete').prop('checked')==true
			|| $('#unit_download').prop('checked')==true
			|| $('#unit_upload').prop('checked')==true) {}else{
                $('#unit_add').iCheck('check');
                $('#unit_edit').iCheck('check');
                $('#unit_delete').iCheck('check');
                $('#unit_download').iCheck('check');
                $('#unit_upload').iCheck('check');
            }
        }else{
            $('#unit_add').iCheck('uncheck');
            $('#unit_edit').iCheck('uncheck');
            $('#unit_delete').iCheck('uncheck');
            $('#unit_download').iCheck('uncheck');
            $('#unit_upload').iCheck('uncheck');
        }
    });

    $('#item').on('ifChanged',function(){
        if (this.checked) {
            if ($('#item_add').prop('checked')==true
            || $('#item_edit').prop('checked')==true
            || $('#item_delete').prop('checked')==true
			|| $('#item_download').prop('checked')==true
			|| $('#item_upload').prop('checked')==true) {}else{
                $('#item_add').iCheck('check');
                $('#item_edit').iCheck('check');
                $('#item_delete').iCheck('check');
                $('#item_download').iCheck('check');
                $('#item_upload').iCheck('check');
            }
        }else{
            $('#item_add').iCheck('uncheck');
            $('#item_edit').iCheck('uncheck');
            $('#item_delete').iCheck('uncheck');
            $('#item_download').iCheck('uncheck');
            $('#item_upload').iCheck('uncheck');
        }
    });
	
	$('#supplier').on('ifChanged',function(){
        if (this.checked) {
            if ($('#supplier_add').prop('checked')==true
            || $('#supplier_edit').prop('checked')==true
            || $('#supplier_delete').prop('checked')==true
			|| $('#supplier_download').prop('checked')==true
			|| $('#supplier_upload').prop('checked')==true) {}else{
                $('#supplier_add').iCheck('check');
                $('#supplier_edit').iCheck('check');
                $('#supplier_delete').iCheck('check');
                $('#supplier_download').iCheck('check');
                $('#supplier_upload').iCheck('check');
            }
        }else{
            $('#supplier_add').iCheck('uncheck');
            $('#supplier_edit').iCheck('uncheck');
            $('#supplier_delete').iCheck('uncheck');
            $('#supplier_download').iCheck('uncheck');
            $('#supplier_upload').iCheck('uncheck');
        }
    });
	
	$('#supplier_item').on('ifChanged',function(){
        if (this.checked) {
            if ($('#supplier_item_add').prop('checked')==true
            || $('#supplier_item_edit').prop('checked')==true
            || $('#supplier_item_delete').prop('checked')==true
			|| $('#supplier_item_download').prop('checked')==true) {}else{
                $('#supplier_item_add').iCheck('check');
                $('#supplier_item_edit').iCheck('check');
                $('#supplier_item_delete').iCheck('check');
                $('#supplier_item_download').iCheck('check');
            }
        }else{
            $('#supplier_item_add').iCheck('uncheck');
            $('#supplier_item_edit').iCheck('uncheck');
            $('#supplier_item_delete').iCheck('uncheck');
            $('#supplier_item_download').iCheck('uncheck');
        }
    });

    $('#item_type_add').on('ifChanged',function(){
        if (this.checked) {
            $('#item_type').iCheck('check');
        }else{
            if ($('#item_type_edit').prop('checked')==true
            || $('#item_type_delete').prop('checked')==true
            || $('#item_type_download').prop('checked')==true
            || $('#item_type_upload').prop('checked')==true) {
                $('#item_type').iCheck('check');
            }else{
                $('#item_type').iCheck('uncheck');
            }
        }
    });

    $('#item_type_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#item_type').iCheck('check');
        }else{
            if ($('#item_type_add').prop('checked')==true
            || $('#item_type_delete').prop('checked')==true
            || $('#item_type_download').prop('checked')==true
            || $('#item_type_upload').prop('checked')==true) {
                $('#item_type').iCheck('check');
            }else{
                $('#item_type').iCheck('uncheck');
            }
        }
    });

    $('#item_type_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#item_type').iCheck('check');
        }else{
            if ($('#item_type_add').prop('checked')==true
            || $('#item_type_edit').prop('checked')==true
            || $('#item_type_download').prop('checked')==true
            || $('#item_type_upload').prop('checked')==true) {
                $('#item_type').iCheck('check');
            }else{
                $('#item_type').iCheck('uncheck');
            }
        }
    });

    $('#item_type_download').on('ifChanged',function(){
        if (this.checked) {
            $('#item_type').iCheck('check');
        }else{
            if ($('#item_type_add').prop('checked')==true
            || $('#item_type_edit').prop('checked')==true
            || $('#item_type_delete').prop('checked')==true
            || $('#item_type_upload').prop('checked')==true) {
                $('#item_type').iCheck('check');
            }else{
                $('#item_type').iCheck('uncheck');
            }
        }
    });

    $('#item_type_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#item_type').iCheck('check');
        }else{
            if ($('#item_type_add').prop('checked')==true
            || $('#item_type_edit').prop('checked')==true
            || $('#item_type_delete').prop('checked')==true
            || $('#item_type_download').prop('checked')==true) {
                $('#item_type').iCheck('check');
            }else{
                $('#item_type').iCheck('uncheck');
            }
        }
    });

    $('#unit_add').on('ifChanged',function(){
        if (this.checked) {
            $('#unit').iCheck('check');
        }else{
            if ($('#unit_edit').prop('checked')==true
            || $('#unit_delete').prop('checked')==true
			|| $('#unit_download').prop('checked')==true
			|| $('#unit_upload').prop('checked')==true) {
                $('#unit').iCheck('check');
            }else{
                $('#unit').iCheck('uncheck');
            }
        }
    });

    $('#unit_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#unit').iCheck('check');
        }else{
            if ($('#unit_add').prop('checked')==true
            || $('#unit_delete').prop('checked')==true
			|| $('#unit_download').prop('checked')==true
			|| $('#unit_upload').prop('checked')==true) {
                $('#unit').iCheck('check');
            }else{
                $('#unit').iCheck('uncheck');
            }
        }
    });

    $('#unit_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#unit').iCheck('check');
        }else{
            if ($('#unit_add').prop('checked')==true
            || $('#unit_edit').prop('checked')==true
			|| $('#unit_download').prop('checked')==true
			|| $('#unit_upload').prop('checked')==true) {
                $('#unit').iCheck('check');
            }else{
                $('#unit').iCheck('uncheck');
            }
        }
    });
	
	$('#unit_download').on('ifChanged',function(){
        if (this.checked) {
            $('#unit').iCheck('check');
        }else{
            if ($('#unit_add').prop('checked')==true
            || $('#unit_edit').prop('checked')==true
			|| $('#unit_delete').prop('checked')==true
			|| $('#unit_upload').prop('checked')==true) {
                $('#unit').iCheck('check');
            }else{
                $('#unit').iCheck('uncheck');
            }
        }
    });
	
	$('#unit_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#unit').iCheck('check');
        }else{
            if ($('#unit_add').prop('checked')==true
            || $('#unit_edit').prop('checked')==true
			|| $('#unit_delete').prop('checked')==true
			|| $('#unit_download').prop('checked')==true) {
                $('#unit').iCheck('check');
            }else{
                $('#unit').iCheck('uncheck');
            }
        }
    });

    $('#item_add').on('ifChanged',function(){
        if (this.checked) {
            $('#item').iCheck('check');
        }else{
            if ($('#item_delete').prop('checked')==true
            || $('#item_edit').prop('checked')==true
			|| $('#item_download').prop('checked')==true
			|| $('#item_upload').prop('checked')==true) {
                $('#item').iCheck('check');
            }else{
                $('#item').iCheck('uncheck');
            }
        }
    });

    $('#item_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#item').iCheck('check');
        }else{
            if ($('#item_delete').prop('checked')==true
            || $('#item_add').prop('checked')==true
			|| $('#item_download').prop('checked')==true
			|| $('#item_upload').prop('checked')==true) {
                $('#item').iCheck('check');
            }else{
                $('#item').iCheck('uncheck');
            }
        }
    });

    $('#item_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#item').iCheck('check');
        }else{
            if ($('#item_edit').prop('checked')==true
            || $('#item_add').prop('checked')==true
			|| $('#item_download').prop('checked')==true
			|| $('#item_upload').prop('checked')==true) {
                $('#item').iCheck('check');
            }else{
                $('#item').iCheck('uncheck');
            }
        }
    });
	
	$('#item_download').on('ifChanged',function(){
        if (this.checked) {
            $('#item').iCheck('check');
        }else{
            if ($('#item_edit').prop('checked')==true
            || $('#item_add').prop('checked')==true
			|| $('#item_delete').prop('checked')==true
			|| $('#item_upload').prop('checked')==true) {
                $('#item').iCheck('check');
            }else{
                $('#item').iCheck('uncheck');
            }
        }
    });
	
	$('#item_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#item').iCheck('check');
        }else{
            if ($('#item_edit').prop('checked')==true
            || $('#item_add').prop('checked')==true
			|| $('#item_download').prop('checked')==true
			|| $('#item_delete').prop('checked')==true) {
                $('#item').iCheck('check');
            }else{
                $('#item').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier_add').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier').iCheck('check');
        }else{
            if ($('#supplier_delete').prop('checked')==true
            || $('#supplier_edit').prop('checked')==true
			|| $('#supplier_download').prop('checked')==true
			|| $('#supplier_upload').prop('checked')==true) {
                $('#supplier').iCheck('check');
            }else{
                $('#supplier').iCheck('uncheck');
            }
        }
    });

    $('#supplier_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier').iCheck('check');
        }else{
            if ($('#supplier_delete').prop('checked')==true
            || $('#supplier_add').prop('checked')==true
			|| $('#supplier_download').prop('checked')==true
			|| $('#supplier_upload').prop('checked')==true) {
                $('#supplier').iCheck('check');
            }else{
                $('#supplier').iCheck('uncheck');
            }
        }
    });

    $('#supplier_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier').iCheck('check');
        }else{
            if ($('#supplier_edit').prop('checked')==true
            || $('#supplier_add').prop('checked')==true
			|| $('#supplier_download').prop('checked')==true
			|| $('#supplier_upload').prop('checked')==true) {
                $('#supplier').iCheck('check');
            }else{
                $('#supplier').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier_download').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier').iCheck('check');
        }else{
            if ($('#supplier_edit').prop('checked')==true
            || $('#supplier_add').prop('checked')==true
			|| $('#supplier_delete').prop('checked')==true
			|| $('#supplier_upload').prop('checked')==true) {
                $('#supplier').iCheck('check');
            }else{
                $('#supplier').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier').iCheck('check');
        }else{
            if ($('#supplier_edit').prop('checked')==true
            || $('#supplier_add').prop('checked')==true
			|| $('#supplier_download').prop('checked')==true
			|| $('#supplier_delete').prop('checked')==true) {
                $('#supplier').iCheck('check');
            }else{
                $('#supplier').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier_item_add').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier_item').iCheck('check');
        }else{
            if ($('#supplier_item_delete').prop('checked')==true
            || $('#supplier_item_edit').prop('checked')==true
			|| $('#supplier_item_download').prop('checked')==true) {
                $('#supplier_item').iCheck('check');
            }else{
                $('#supplier_item').iCheck('uncheck');
            }
        }
    });

    $('#supplier_item_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier_item_item').iCheck('check');
        }else{
            if ($('#supplier_item_delete').prop('checked')==true
            || $('#supplier_item_add').prop('checked')==true
			|| $('#supplier_item_download').prop('checked')==true) {
                $('#supplier_item_item').iCheck('check');
            }else{
                $('#supplier_item_item').iCheck('uncheck');
            }
        }
    });

    $('#supplier_item_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier_item').iCheck('check');
        }else{
            if ($('#supplier_item_edit').prop('checked')==true
            || $('#supplier_item_add').prop('checked')==true
			|| $('#supplier_item_download').prop('checked')==true) {
                $('#supplier_item').iCheck('check');
            }else{
                $('#supplier_item').iCheck('uncheck');
            }
        }
    });
	
	$('#supplier_item_download').on('ifChanged',function(){
        if (this.checked) {
            $('#supplier_item').iCheck('check');
        }else{
            if ($('#supplier_item_edit').prop('checked')==true
            || $('#supplier_item_add').prop('checked')==true
			|| $('#supplier_item_delete').prop('checked')==true) {
                $('#supplier_item').iCheck('check');
            }else{
                $('#supplier_item').iCheck('uncheck');
            }
        }
    });

	// ============================== End Item Info ============================ //

	$('#house_type').on('ifChanged',function(){
        if (this.checked) {
            $('#house_info').iCheck('check');
        }else{
            if ($('#house').prop('checked')==true 
			|| $('#boq').prop('checked')==true) {
                $('#house_info').iCheck('check');
            }else{
                $('#house_info').iCheck('uncheck'); 
            }
        }
    });
	
	$('#house').on('ifChanged',function(){
        if (this.checked) {
            $('#house_info').iCheck('check');
        }else{
            if ($('#house_type').prop('checked')==true 
			|| $('#boq').prop('checked')==true) {
                $('#house_info').iCheck('check');
            }else{
                $('#house_info').iCheck('uncheck'); 
            }
        }
    });
	
	$('#boq').on('ifChanged',function(){
        if (this.checked) {
            $('#house_info').iCheck('check');
        }else{
            if ($('#house_type').prop('checked')==true 
			|| $('#house').prop('checked')==true) {
                $('#house_info').iCheck('check');
            }else{
                $('#house_info').iCheck('uncheck'); 
            }
        }
    });
	
	$('#house_type').on('ifChanged',function(){
        if (this.checked) {
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_edit').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
            || $('#house_type_download').prop('checked')==true
            || $('#house_type_upload').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {}else{
				
                $('#house_type_add').iCheck('check');
                $('#house_type_edit').iCheck('check');
                $('#house_type_delete').iCheck('check');
                $('#house_type_download').iCheck('check');
                $('#house_type_upload').iCheck('check');
                $('#house_type_enter_boq').iCheck('check');
                $('#house_type_upload_boq').iCheck('check');
            }
        }else{
            $('#house_type_add').iCheck('uncheck');
            $('#house_type_edit').iCheck('uncheck');
            $('#house_type_delete').iCheck('uncheck');
            $('#house_type_download').iCheck('uncheck');
            $('#house_type_upload').iCheck('uncheck');
            $('#house_type_enter_boq').iCheck('uncheck');
            $('#house_type_upload_boq').iCheck('uncheck');
        }
    });
	
	$('#house').on('ifChanged',function(){
        if (this.checked) {
            if ($('#house_add').prop('checked')==true
            || $('#house_edit').prop('checked')==true
            || $('#house_delete').prop('checked')==true
            || $('#house_download').prop('checked')==true
            || $('#house_upload').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {}else{
				
                $('#house_add').iCheck('check');
                $('#house_edit').iCheck('check');
                $('#house_delete').iCheck('check');
                $('#house_download').iCheck('check');
                $('#house_upload').iCheck('check');
                $('#house_enter_boq').iCheck('check');
                $('#house_upload_boq').iCheck('check');
            }
        }else{
            $('#house_add').iCheck('uncheck');
            $('#house_edit').iCheck('uncheck');
            $('#house_delete').iCheck('uncheck');
            $('#house_download').iCheck('uncheck');
            $('#house_upload').iCheck('uncheck');
            $('#house_enter_boq').iCheck('uncheck');
            $('#house_upload_boq').iCheck('uncheck');
        }
    });
	
	$('#boq').on('ifChanged',function(){
        if (this.checked) {
            if ($('#boq_add').prop('checked')==true
            || $('#boq_view').prop('checked')==true
            || $('#boq_delete').prop('checked')==true
            || $('#boq_download').prop('checked')==true
            || $('#boq_download_sample').prop('checked')==true) {}else{
				
                $('#boq_add').iCheck('check');
                $('#boq_view').iCheck('check');
                $('#boq_delete').iCheck('check');
                $('#boq_download').iCheck('check');
                $('#boq_download_sample').iCheck('check');
            }
        }else{
            $('#boq_add').iCheck('uncheck');
            $('#boq_view').iCheck('uncheck');
            $('#boq_delete').iCheck('uncheck');
            $('#boq_download').iCheck('uncheck');
            $('#boq_download_sample').iCheck('uncheck');
        }
    });
	
	$('#house_type_add').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_delete').prop('checked')==true
            || $('#house_type_edit').prop('checked')==true
			|| $('#house_type_download').prop('checked')==true
			|| $('#house_type_upload').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_type_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_edit').prop('checked')==true
			|| $('#house_type_download').prop('checked')==true
			|| $('#house_type_upload').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_type_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
			|| $('#house_type_download').prop('checked')==true
			|| $('#house_type_upload').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_type_download').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
			|| $('#house_type_edit').prop('checked')==true
			|| $('#house_type_upload').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_type_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
			|| $('#house_type_edit').prop('checked')==true
			|| $('#house_type_download').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_type_enter_boq').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
			|| $('#house_type_edit').prop('checked')==true
			|| $('#house_type_download').prop('checked')==true
			|| $('#house_type_upload').prop('checked')==true
			|| $('#house_type_upload_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_type_upload_boq').on('ifChanged',function(){
        if (this.checked) {
            $('#house_type').iCheck('check');
        }else{
            if ($('#house_type_add').prop('checked')==true
            || $('#house_type_delete').prop('checked')==true
			|| $('#house_type_edit').prop('checked')==true
			|| $('#house_type_download').prop('checked')==true
			|| $('#house_type_upload').prop('checked')==true
			|| $('#house_type_enter_boq').prop('checked')==true) {
                $('#house_type').iCheck('check');
            }else{
                $('#house_type').iCheck('uncheck');
            }
        }
    });
	
	$('#house_add').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_delete').prop('checked')==true
            || $('#house_edit').prop('checked')==true
			|| $('#house_download').prop('checked')==true
			|| $('#house_upload').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#house_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_add').prop('checked')==true
            || $('#house_edit').prop('checked')==true
			|| $('#house_download').prop('checked')==true
			|| $('#house_upload').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#house_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_add').prop('checked')==true
            || $('#house_delete').prop('checked')==true
			|| $('#house_download').prop('checked')==true
			|| $('#house_upload').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#house_download').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_add').prop('checked')==true
            || $('#house_delete').prop('checked')==true
			|| $('#house_edit').prop('checked')==true
			|| $('#house_upload').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#house_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_add').prop('checked')==true
            || $('#house_delete').prop('checked')==true
			|| $('#house_edit').prop('checked')==true
			|| $('#house_download').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#house_enter_boq').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_add').prop('checked')==true
            || $('#house_delete').prop('checked')==true
			|| $('#house_edit').prop('checked')==true
			|| $('#house_download').prop('checked')==true
			|| $('#house_upload').prop('checked')==true
			|| $('#house_upload_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#house_upload_boq').on('ifChanged',function(){
        if (this.checked) {
            $('#house').iCheck('check');
        }else{
            if ($('#house_add').prop('checked')==true
            || $('#house_delete').prop('checked')==true
			|| $('#house_edit').prop('checked')==true
			|| $('#house_download').prop('checked')==true
			|| $('#house_upload').prop('checked')==true
			|| $('#house_enter_boq').prop('checked')==true) {
                $('#house').iCheck('check');
            }else{
                $('#house').iCheck('uncheck');
            }
        }
    });
	
	$('#boq_add').on('ifChanged',function(){
        if (this.checked) {
            $('#boq').iCheck('check');
        }else{
            if ($('#boq_delete').prop('checked')==true
			|| $('#boq_view').prop('checked')==true
			|| $('#boq_download').prop('checked')==true
			|| $('#boq_download_sample').prop('checked')==true) {
                $('#boq').iCheck('check');
            }else{
                $('#boq').iCheck('uncheck');
            }
        }
    });
	
	$('#boq_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#boq').iCheck('check');
        }else{
            if ($('#boq_add').prop('checked')==true
			|| $('#boq_view').prop('checked')==true
			|| $('#boq_download').prop('checked')==true
			|| $('#boq_download_sample').prop('checked')==true) {
                $('#boq').iCheck('check');
            }else{
                $('#boq').iCheck('uncheck');
            }
        }
    });
	
	$('#boq_view').on('ifChanged',function(){
        if (this.checked) {
            $('#boq').iCheck('check');
        }else{
            if ($('#boq_add').prop('checked')==true
			|| $('#boq_delete').prop('checked')==true
			|| $('#boq_download').prop('checked')==true
			|| $('#boq_download_sample').prop('checked')==true) {
                $('#boq').iCheck('check');
            }else{
                $('#boq').iCheck('uncheck');
            }
        }
    });
	
	$('#boq_download').on('ifChanged',function(){
        if (this.checked) {
            $('#boq').iCheck('check');
        }else{
            if ($('#boq_add').prop('checked')==true
			|| $('#boq_delete').prop('checked')==true
			|| $('#boq_view').prop('checked')==true
			|| $('#boq_download_sample').prop('checked')==true) {
                $('#boq').iCheck('check');
            }else{
                $('#boq').iCheck('uncheck');
            }
        }
    });
	
	$('#boq_download_sample').on('ifChanged',function(){
        if (this.checked) {
            $('#boq').iCheck('check');
        }else{
            if ($('#boq_add').prop('checked')==true
			|| $('#boq_delete').prop('checked')==true
			|| $('#boq_view').prop('checked')==true
			|| $('#boq_download').prop('checked')==true) {
                $('#boq').iCheck('check');
            }else{
                $('#boq').iCheck('uncheck');
            }
        }
    });
	
	// ======================= End House Info ======================== //
	
	$('#purchase_request').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase').iCheck('check');
        }else{
            if ($('#purchase_order').prop('checked')==true) {
                $('#purchase').iCheck('check');
            }else{
                $('#purchase').iCheck('uncheck'); 
            }
        }
    });
	
	$('#purchase_order').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase').iCheck('check');
        }else{
            if ($('#purchase_request').prop('checked')==true) {
                $('#purchase').iCheck('check');
            }else{
                $('#purchase').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_request').on('ifChanged',function(){
        if (this.checked) {
            if ($('#purchase_request_add').prop('checked')==true
            || $('#purchase_request_edit').prop('checked')==true
            || $('#purchase_request_delete').prop('checked')==true
            || $('#purchase_request_print').prop('checked')==true
            || $('#purchase_request_view').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true) {}else{
				
                $('#purchase_request_add').iCheck('check');
                $('#purchase_request_edit').iCheck('check');
                $('#purchase_request_delete').iCheck('check');
                $('#purchase_request_print').iCheck('check');
                $('#purchase_request_view').iCheck('check');
                $('#purchase_request_clone').iCheck('check');
            }
        }else{
            $('#purchase_request_add').iCheck('uncheck');
            $('#purchase_request_edit').iCheck('uncheck');
            $('#purchase_request_delete').iCheck('uncheck');
            $('#purchase_request_print').iCheck('uncheck');
            $('#purchase_request_view').iCheck('uncheck');
            $('#purchase_request_clone').iCheck('uncheck');
        }
    });
	
	$('#purchase_order').on('ifChanged',function(){
        if (this.checked) {
            if ($('#purchase_order_add').prop('checked')==true
            || $('#purchase_order_edit').prop('checked')==true
            || $('#purchase_order_delete').prop('checked')==true
            || $('#purchase_order_print').prop('checked')==true
            || $('#purchase_order_view').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true) {}else{
				
                $('#purchase_order_add').iCheck('check');
                $('#purchase_order_edit').iCheck('check');
                $('#purchase_order_delete').iCheck('check');
                $('#purchase_order_print').iCheck('check');
                $('#purchase_order_view').iCheck('check');
                $('#purchase_order_clone').iCheck('check');
            }
        }else{
            $('#purchase_order_add').iCheck('uncheck');
            $('#purchase_order_edit').iCheck('uncheck');
            $('#purchase_order_delete').iCheck('uncheck');
            $('#purchase_order_print').iCheck('uncheck');
            $('#purchase_order_view').iCheck('uncheck');
            $('#purchase_order_clone').iCheck('uncheck');
        }
    });
	
	$('#purchase_request_add').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_request').iCheck('check');
        }else{
            if ($('#purchase_request_edit').prop('checked')==true
            || $('#purchase_request_delete').prop('checked')==true
			|| $('#purchase_request_print').prop('checked')==true
			|| $('#purchase_request_view').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true) {
                $('#purchase_request').iCheck('check');
            }else{
                $('#purchase_request').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_request_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_request').iCheck('check');
        }else{
            if ($('#purchase_request_add').prop('checked')==true
            || $('#purchase_request_delete').prop('checked')==true
			|| $('#purchase_request_print').prop('checked')==true
			|| $('#purchase_request_view').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true) {
                $('#purchase_request').iCheck('check');
            }else{
                $('#purchase_request').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_request_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_request').iCheck('check');
        }else{
            if ($('#purchase_request_edit').prop('checked')==true
            || $('#purchase_request_add').prop('checked')==true
			|| $('#purchase_request_print').prop('checked')==true
			|| $('#purchase_request_view').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true) {
                $('#purchase_request').iCheck('check');
            }else{
                $('#purchase_request').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_request_print').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_request').iCheck('check');
        }else{
            if ($('#purchase_request_edit').prop('checked')==true
            || $('#purchase_request_delete').prop('checked')==true
			|| $('#purchase_request_add').prop('checked')==true
			|| $('#purchase_request_view').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true) {
                $('#purchase_request').iCheck('check');
            }else{
                $('#purchase_request').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_request_view').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_request').iCheck('check');
        }else{
            if ($('#purchase_request_edit').prop('checked')==true
            || $('#purchase_request_delete').prop('checked')==true
			|| $('#purchase_request_print').prop('checked')==true
			|| $('#purchase_request_add').prop('checked')==true
			|| $('#purchase_request_clone').prop('checked')==true) {
                $('#purchase_request').iCheck('check');
            }else{
                $('#purchase_request').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_request_clone').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_request').iCheck('check');
        }else{
            if ($('#purchase_request_edit').prop('checked')==true
            || $('#purchase_request_delete').prop('checked')==true
			|| $('#purchase_request_print').prop('checked')==true
			|| $('#purchase_request_add').prop('checked')==true
			|| $('#purchase_request_view').prop('checked')==true) {
                $('#purchase_request').iCheck('check');
            }else{
                $('#purchase_request').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_order_add').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_order').iCheck('check');
        }else{
            if ($('#purchase_order_edit').prop('checked')==true
            || $('#purchase_order_delete').prop('checked')==true
			|| $('#purchase_order_print').prop('checked')==true
			|| $('#purchase_order_view').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true) {
                $('#purchase_order').iCheck('check');
            }else{
                $('#purchase_order').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_order_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_order').iCheck('check');
        }else{
            if ($('#purchase_order_add').prop('checked')==true
            || $('#purchase_order_delete').prop('checked')==true
			|| $('#purchase_order_print').prop('checked')==true
			|| $('#purchase_order_view').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true) {
               $('#purchase_order').iCheck('check');
            }else{
                $('#purchase_order').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_order_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_order').iCheck('check');
        }else{
            if ($('#purchase_order_edit').prop('checked')==true
            || $('#purchase_order_add').prop('checked')==true
			|| $('#purchase_order_print').prop('checked')==true
			|| $('#purchase_order_view').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true) {
               $('#purchase_order').iCheck('check');
            }else{
                $('#purchase_order').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_order_print').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_order').iCheck('check');
        }else{
            if ($('#purchase_order_edit').prop('checked')==true
            || $('#purchase_order_delete').prop('checked')==true
			|| $('#purchase_order_add').prop('checked')==true
			|| $('#purchase_order_view').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true) {
               $('#purchase_order').iCheck('check');
            }else{
               $('#purchase_order').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_order_view').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_order').iCheck('check');
        }else{
            if ($('#purchase_order_edit').prop('checked')==true
            || $('#purchase_order_delete').prop('checked')==true
			|| $('#purchase_order_print').prop('checked')==true
			|| $('#purchase_order_add').prop('checked')==true
			|| $('#purchase_order_clone').prop('checked')==true) {
               $('#purchase_order').iCheck('check');
            }else{
               $('#purchase_order').iCheck('uncheck');
            }
        }
    });
	
	$('#purchase_order_clone').on('ifChanged',function(){
        if (this.checked) {
            $('#purchase_order').iCheck('check');
        }else{
            if ($('#purchase_order_edit').prop('checked')==true
            || $('#purchase_order_delete').prop('checked')==true
			|| $('#purchase_order_print').prop('checked')==true
			|| $('#purchase_order_add').prop('checked')==true
			|| $('#purchase_order_view').prop('checked')==true) {
               $('#purchase_order').iCheck('check');
            }else{
               $('#purchase_order').iCheck('uncheck');
            }
        }
    });
	
	// ======================== End Purchase ========================= //
	
	$('#approve_request').on('ifChanged',function(){
        if (this.checked) {
            $('#approve').iCheck('check');
        }else{
            if ($('#approve_order').prop('checked')==true) {
                $('#approve').iCheck('check');
            }else{
                $('#approve').iCheck('uncheck'); 
            }
        }
    });
	
	$('#approve_order').on('ifChanged',function(){
        if (this.checked) {
            $('#approve').iCheck('check');
        }else{
            if ($('#approve_request').prop('checked')==true) {
                $('#approve').iCheck('check');
            }else{
                $('#approve').iCheck('uncheck');
            }
        }
    });
	
	$('#approve_request').on('ifChanged',function(){
        if (this.checked) {
            if ($('#approve_request_view').prop('checked')==true
            || $('#approve_request_signature').prop('checked')==true
            || $('#approve_request_reject').prop('checked')==true) {}else{
				
                $('#approve_request_view').iCheck('check');
                $('#approve_request_signature').iCheck('check');
                $('#approve_request_reject').iCheck('check');
            }
        }else{
            $('#approve_request_view').iCheck('uncheck');
            $('#approve_request_signature').iCheck('uncheck');
            $('#approve_request_reject').iCheck('uncheck');
        }
    });
	
	$('#approve_order').on('ifChanged',function(){
        if (this.checked) {
            if ($('#approve_order_view').prop('checked')==true
            || $('#approve_order_signature').prop('checked')==true
            || $('#approve_order_reject').prop('checked')==true) {}else{
				
                $('#approve_order_view').iCheck('check');
                $('#approve_order_signature').iCheck('check');
                $('#approve_order_reject').iCheck('check');
            }
        }else{
            $('#approve_order_view').iCheck('uncheck');
            $('#approve_order_signature').iCheck('uncheck');
            $('#approve_order_reject').iCheck('uncheck');
        }
    });
	
	$('#approve_request_view').on('ifChanged',function(){
        if (this.checked) {
            $('#approve_request').iCheck('check');
        }else{
            if ($('#approve_request_signature').prop('checked')==true
            || $('#approve_request_reject').prop('checked')==true) {
               $('#approve_request').iCheck('check');
            }else{
               $('#approve_request').iCheck('uncheck');
            }
        }
    });
	
	$('#approve_request_signature').on('ifChanged',function(){
        if (this.checked) {
            $('#approve_request').iCheck('check');
        }else{
            if ($('#approve_request_view').prop('checked')==true
            || $('#approve_request_reject').prop('checked')==true) {
               $('#approve_request').iCheck('check');
            }else{
               $('#approve_request').iCheck('uncheck');
            }
        }
    });
	
	$('#approve_request_reject').on('ifChanged',function(){
        if (this.checked) {
            $('#approve_request').iCheck('check');
        }else{
            if ($('#approve_request_signature').prop('checked')==true
            || $('#approve_request_view').prop('checked')==true) {
               $('#approve_request').iCheck('check');
            }else{
               $('#approve_request').iCheck('uncheck');
            }
        }
    });
	
	$('#approve_order_view').on('ifChanged',function(){
        if (this.checked) {
            $('#approve_order').iCheck('check');
        }else{
            if ($('#approve_order_signature').prop('checked')==true
            || $('#approve_order_reject').prop('checked')==true) {
               $('#approve_order').iCheck('check');
            }else{
               $('#approve_order').iCheck('uncheck');
            }
        }
    });
	
	$('#approve_order_signature').on('ifChanged',function(){
        if (this.checked) {
            $('#approve_order').iCheck('check');
        }else{
            if ($('#approve_order_view').prop('checked')==true
            || $('#approve_order_reject').prop('checked')==true) {
               $('#approve_order').iCheck('check');
            }else{
               $('#approve_order').iCheck('uncheck');
            }
        }
    });
	
	$('#approve_order_reject').on('ifChanged',function(){
        if (this.checked) {
            $('#approve_order').iCheck('check');
        }else{
            if ($('#approve_order_signature').prop('checked')==true
            || $('#approve_order_view').prop('checked')==true) {
               $('#approve_order').iCheck('check');
            }else{
               $('#approve_order').iCheck('uncheck');
            }
        }
    });
	
	// ======================== End Approval ========================= //
	
	$('#department').on('ifChanged',function(){
        if (this.checked) {
            $('#user_control').iCheck('check');
        }else{
            if ($('#user').prop('checked')==true 
			|| $('#user_group').prop('checked')==true 
			|| $('#role').prop('checked')==true) {
                $('#user_control').iCheck('check');
            }else{
                $('#user_control').iCheck('uncheck'); 
            }
        }
    });
	
	$('#user').on('ifChanged',function(){
        if (this.checked) {
            $('#user_control').iCheck('check');
        }else{
            if ($('#department').prop('checked')==true 
			|| $('#user_group').prop('checked')==true 
			|| $('#role').prop('checked')==true) {
                $('#user_control').iCheck('check');
            }else{
                $('#user_control').iCheck('uncheck'); 
            }
        }
    });
	
	$('#user_group').on('ifChanged',function(){
        if (this.checked) {
            $('#user_control').iCheck('check');
        }else{
            if ($('#user').prop('checked')==true 
			|| $('#department').prop('checked')==true 
			|| $('#role').prop('checked')==true) {
                $('#user_control').iCheck('check');
            }else{
                $('#user_control').iCheck('uncheck'); 
            }
        }
    });
	
	$('#role').on('ifChanged',function(){
        if (this.checked) {
            $('#user_control').iCheck('check');
        }else{
            if ($('#user').prop('checked')==true 
			|| $('#user_group').prop('checked')==true 
			|| $('#department').prop('checked')==true) {
                $('#user_control').iCheck('check');
            }else{
                $('#user_control').iCheck('uncheck'); 
            }
        }
    });
	
	$('#department').on('ifChanged',function(){
        if (this.checked) {
            if($('#department_add').prop('checked')==true
            || $('#department_edit').prop('checked')==true
            || $('#department_delete').prop('checked')==true
			|| $('#department_download').prop('checked')==true
			|| $('#department_upload').prop('checked')==true) {}else{
				
                $('#department_add').iCheck('check');
                $('#department_edit').iCheck('check');
                $('#department_delete').iCheck('check');
                $('#department_download').iCheck('check');
                $('#department_upload').iCheck('check');
            }
        }else{
            $('#department_add').iCheck('uncheck');
            $('#department_edit').iCheck('uncheck');
            $('#department_delete').iCheck('uncheck');
            $('#department_download').iCheck('uncheck');
            $('#department_upload').iCheck('uncheck');
        }
    });
	
	$('#user').on('ifChanged',function(){
        if (this.checked) {
            if($('#user_add').prop('checked')==true
            || $('#user_edit').prop('checked')==true
            || $('#user_delete').prop('checked')==true
            || $('#user_reset').prop('checked')==true) {}else{
				
                $('#user_add').iCheck('check');
                $('#user_edit').iCheck('check');
                $('#user_delete').iCheck('check');
                $('#user_reset').iCheck('check');
            }
        }else{
            $('#user_add').iCheck('uncheck');
            $('#user_edit').iCheck('uncheck');
            $('#user_delete').iCheck('uncheck');
            $('#user_reset').iCheck('uncheck');
        }
    });
	
	$('#user_group').on('ifChanged',function(){
        if (this.checked) {
            if($('#user_group_add').prop('checked')==true
            || $('#user_group_edit').prop('checked')==true
            || $('#user_group_delete').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_upload').prop('checked')==true
			|| $('#user_group_assign').prop('checked')==true) {}else{
				
                $('#user_group_add').iCheck('check');
                $('#user_group_edit').iCheck('check');
                $('#user_group_delete').iCheck('check');
                $('#user_group_download').iCheck('check');
                $('#user_group_upload').iCheck('check');
                $('#user_group_assign').iCheck('check');
            }
        }else{
            $('#user_group_add').iCheck('uncheck');
            $('#user_group_edit').iCheck('uncheck');
            $('#user_group_delete').iCheck('uncheck');
            $('#user_group_download').iCheck('uncheck');
            $('#user_group_upload').iCheck('uncheck');
            $('#user_group_assign').iCheck('uncheck');
        }
    });
	
	$('#role').on('ifChanged',function(){
        if (this.checked) {
            if($('#role_add').prop('checked')==true
            || $('#role_edit').prop('checked')==true
            || $('#role_delete').prop('checked')==true
			|| $('#role_assign').prop('checked')==true) {}else{
				
                $('#role_add').iCheck('check');
                $('#role_edit').iCheck('check');
                $('#role_delete').iCheck('check');
                $('#role_assign').iCheck('check');
            }
        }else{
            $('#role_add').iCheck('uncheck');
            $('#role_edit').iCheck('uncheck');
            $('#role_delete').iCheck('uncheck');
            $('#role_assign').iCheck('uncheck');
        }
    });
	
	$('#department_add').on('ifChanged',function(){
        if (this.checked) {
            $('#department').iCheck('check');
        }else{
            if($('#department_edit').prop('checked')==true
            || $('#department_delete').prop('checked')==true
			|| $('#department_download').prop('checked')==true
			|| $('#department_upload').prop('checked')==true) {
               $('#department').iCheck('check');
            }else{
               $('#department').iCheck('uncheck');
            }
        }
    });
	
	$('#department_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#department').iCheck('check');
        }else{
            if($('#department_add').prop('checked')==true
            || $('#department_delete').prop('checked')==true
			|| $('#department_download').prop('checked')==true
			|| $('#department_upload').prop('checked')==true) {
               $('#department').iCheck('check');
            }else{
               $('#department').iCheck('uncheck');
            }
        }
    });
	
	$('#department_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#department').iCheck('check');
        }else{
            if($('#department_edit').prop('checked')==true
            || $('#department_add').prop('checked')==true
			|| $('#department_download').prop('checked')==true
			|| $('#department_upload').prop('checked')==true) {
               $('#department').iCheck('check');
            }else{
               $('#department').iCheck('uncheck');
            }
        }
    });
	
	$('#department_download').on('ifChanged',function(){
        if (this.checked) {
            $('#department').iCheck('check');
        }else{
            if($('#department_edit').prop('checked')==true
            || $('#department_delete').prop('checked')==true
			|| $('#department_add').prop('checked')==true
			|| $('#department_upload').prop('checked')==true) {
               $('#department').iCheck('check');
            }else{
               $('#department').iCheck('uncheck');
            }
        }
    });
	
	$('#department_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#department').iCheck('check');
        }else{
            if($('#department_edit').prop('checked')==true
            || $('#department_delete').prop('checked')==true
			|| $('#department_download').prop('checked')==true
			|| $('#department_add').prop('checked')==true) {
               $('#department').iCheck('check');
            }else{
               $('#department').iCheck('uncheck');
            }
        }
    });
	
	$('#user_add').on('ifChanged',function(){
        if (this.checked) {
            $('#user').iCheck('check');
        }else{
            if($('#user_edit').prop('checked')==true
            || $('#user_delete').prop('checked')==true
			|| $('#user_reset').prop('checked')==true
			|| $('#user_assign').prop('checked')==true) {
               $('#user').iCheck('check');
            }else{
               $('#user').iCheck('uncheck');
            }
        }
    });
	$('#user_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#user').iCheck('check');
        }else{
            if($('#user_add').prop('checked')==true
            || $('#user_delete').prop('checked')==true
			|| $('#user_reset').prop('checked')==true
			|| $('#user_assign').prop('checked')==true) {
               $('#user').iCheck('check');
            }else{
               $('#user').iCheck('uncheck');
            }
        }
    });
	
	$('#user_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#user').iCheck('check');
        }else{
            if($('#user_edit').prop('checked')==true
            || $('#user_add').prop('checked')==true
			|| $('#user_reset').prop('checked')==true
			|| $('#user_assign').prop('checked')==true) {
               $('#user').iCheck('check');
            }else{
               $('#user').iCheck('uncheck');
            }
        }
    });
	
	$('#user_reset').on('ifChanged',function(){
        if (this.checked) {
            $('#user').iCheck('check');
        }else{
            if($('#user_edit').prop('checked')==true
            || $('#user_delete').prop('checked')==true
			|| $('#user_add').prop('checked')==true
			|| $('#user_assign').prop('checked')==true) {
               $('#user').iCheck('check');
            }else{
               $('#user').iCheck('uncheck');
            }
        }
    });
	
	$('#user_group_add').on('ifChanged',function(){
        if (this.checked) {
            $('#user_group').iCheck('check');
        }else{
            if($('#user_group_edit').prop('checked')==true
            || $('#user_group_delete').prop('checked')==true
			|| $('#user_group_assign').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_upload').prop('checked')==true) {
               $('#user_group').iCheck('check');
            }else{
               $('#user_group').iCheck('uncheck');
            }
        }
    });
	
	$('#user_group_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#user_group').iCheck('check');
        }else{
            if($('#user_group_upload').prop('checked')==true
            || $('#user_group_delete').prop('checked')==true
			|| $('#user_group_assign').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_add').prop('checked')==true) {
               $('#user_group').iCheck('check');
            }else{
               $('#user_group').iCheck('uncheck');
            }
        }
    });
	
	$('#user_group_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#user_group').iCheck('check');
        }else{
            if($('#user_group_edit').prop('checked')==true
            || $('#user_group_upload').prop('checked')==true
			|| $('#user_group_assign').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_add').prop('checked')==true) {
               $('#user_group').iCheck('check');
            }else{
               $('#user_group').iCheck('uncheck');
            }
        }
    });
	
	$('#user_group_download').on('ifChanged',function(){
        if (this.checked) {
            $('#user_group').iCheck('check');
        }else{
            if($('#user_group_edit').prop('checked')==true
            || $('#user_group_delete').prop('checked')==true
			|| $('#user_group_assign').prop('checked')==true
			|| $('#user_group_upload').prop('checked')==true
			|| $('#user_group_add').prop('checked')==true) {
               $('#user_group').iCheck('check');
            }else{
               $('#user_group').iCheck('uncheck');
            }
        }
    });
	
	$('#user_group_upload').on('ifChanged',function(){
        if (this.checked) {
            $('#user_group').iCheck('check');
        }else{
            if($('#user_group_edit').prop('checked')==true
            || $('#user_group_delete').prop('checked')==true
            || $('#user_group_assign').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_add').prop('checked')==true) {
               $('#user_group').iCheck('check');
            }else{
               $('#user_group').iCheck('uncheck');
            }
        }
    });
	
	$('#user_group_assign').on('ifChanged',function(){
        if (this.checked) {
            $('#user_group').iCheck('check');
        }else{
            if($('#user_group_edit').prop('checked')==true
            || $('#user_group_delete').prop('checked')==true
			|| $('#user_group_download').prop('checked')==true
			|| $('#user_group_upload').prop('checked')==true
			|| $('#user_group_add').prop('checked')==true) {
               $('#user_group').iCheck('check');
            }else{
               $('#user_group').iCheck('uncheck');
            }
        }
    });
	
	$('#role_add').on('ifChanged',function(){
        if (this.checked) {
            $('#role').iCheck('check');
        }else{
            if($('#role_edit').prop('checked')==true
            || $('#role_delete').prop('checked')==true
			|| $('#role_assign').prop('checked')==true) {
               $('#role').iCheck('check');
            }else{
               $('#role').iCheck('uncheck');
            }
        }
    });
	
	$('#role_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#role').iCheck('check');
        }else{
            if($('#role_add').prop('checked')==true
            || $('#role_delete').prop('checked')==true
			|| $('#role_assign').prop('checked')==true) {
               $('#role').iCheck('check');
            }else{
               $('#role').iCheck('uncheck');
            }
        }
    });
	
	$('#role_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#role').iCheck('check');
        }else{
            if($('#role_edit').prop('checked')==true
            || $('#role_add').prop('checked')==true
			|| $('#role_assign').prop('checked')==true) {
               $('#role').iCheck('check');
            }else{
               $('#role').iCheck('uncheck');
            }
        }
    });
	
	$('#role_assign').on('ifChanged',function(){
        if (this.checked) {
            $('#role').iCheck('check');
        }else{
            if($('#role_edit').prop('checked')==true
            || $('#role_delete').prop('checked')==true
			|| $('#role_add').prop('checked')==true) {
               $('#role').iCheck('check');
            }else{
               $('#role').iCheck('uncheck');
            }
        }
    });
	
	// ======================== End User Control ===================== //
	
	$('#setting').on('ifChanged',function(){
        if (this.checked) {
            $('#system').iCheck('check');
        }else{
            if ($('#user_log').prop('checked')==true 
			|| $('#backup').prop('checked')==true 
			|| $('#trash').prop('checked')==true) {
                $('#system').iCheck('check');
            }else{
                $('#system').iCheck('uncheck'); 
            }
        }
    });
	
	$('#user_log').on('ifChanged',function(){
        if (this.checked) {
            $('#system').iCheck('check');
        }else{
            if ($('#setting').prop('checked')==true 
			|| $('#backup').prop('checked')==true 
			|| $('#trash').prop('checked')==true) {
                $('#system').iCheck('check');
            }else{
                $('#system').iCheck('uncheck'); 
            }
        }
    });
	
	$('#backup').on('ifChanged',function(){
        if (this.checked) {
            $('#system').iCheck('check');
        }else{
            if ($('#setting').prop('checked')==true 
			|| $('#user_log').prop('checked')==true 
			|| $('#trash').prop('checked')==true) {
                $('#system').iCheck('check');
            }else{
                $('#system').iCheck('uncheck'); 
            }
        }
    });
	
	$('#trash').on('ifChanged',function(){
        if (this.checked) {
            $('#system').iCheck('check');
        }else{
            if ($('#setting').prop('checked')==true 
			|| $('#user_log').prop('checked')==true 
			|| $('#backup').prop('checked')==true) {
                $('#system').iCheck('check');
            }else{
                $('#system').iCheck('uncheck'); 
            }
        }
    });
	
	$('#backup').on('ifChanged',function(){
        if (this.checked) {
            if($('#backup_add').prop('checked')==true
            || $('#backup_delete').prop('checked')==true
			|| $('#backup_download').prop('checked')==true) {}else{
				
                $('#backup_add').iCheck('check');
                $('#backup_delete').iCheck('check');
                $('#backup_download').iCheck('check');
            }
        }else{
            $('#backup_add').iCheck('uncheck');
            $('#backup_delete').iCheck('uncheck');
            $('#backup_download').iCheck('uncheck');
        }
    });
	
	$('#trash').on('ifChanged',function(){
        if (this.checked) {
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
            || $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {}else{
				
                $('#trash_stock_entry').iCheck('check');
                $('#trash_stock_import').iCheck('check');
                $('#trash_stock_adjust').iCheck('check');
                $('#trash_stock_move').iCheck('check');
                $('#trash_stock_delivery').iCheck('check');
                $('#trash_stock_return_delivery').iCheck('check');
                $('#trash_stock_usage').iCheck('check');
                $('#trash_stock_return_usage').iCheck('check');
                $('#trash_request').iCheck('check');
                $('#trash_order').iCheck('check');
            }
        }else{
            $('#trash_stock_entry').iCheck('uncheck');
			$('#trash_stock_import').iCheck('uncheck');
			$('#trash_stock_adjust').iCheck('uncheck');
			$('#trash_stock_move').iCheck('uncheck');
			$('#trash_stock_delivery').iCheck('uncheck');
			$('#trash_stock_return_delivery').iCheck('uncheck');
			$('#trash_stock_usage').iCheck('uncheck');
            $('#trash_stock_return_usage').iCheck('uncheck');
            $('#trash_request').iCheck('uncheck');
			$('#trash_order').iCheck('uncheck');
        }
    });
	
	$('#backup_add').on('ifChanged',function(){
        if (this.checked) {
            $('#backup').iCheck('check');
        }else{
            if($('#backup_download').prop('checked')==true
            || $('#backup_delete').prop('checked')==true) {
               $('#backup').iCheck('check');
            }else{
               $('#backup').iCheck('uncheck');
            }
        }
    });
	
	$('#backup_download').on('ifChanged',function(){
        if (this.checked) {
            $('#backup').iCheck('check');
        }else{
            if($('#backup_add').prop('checked')==true
            || $('#backup_delete').prop('checked')==true) {
               $('#backup').iCheck('check');
            }else{
               $('#backup').iCheck('uncheck');
            }
        }
    });
	
	$('#backup_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#backup').iCheck('check');
        }else{
            if($('#backup_download').prop('checked')==true
            || $('#backup_add').prop('checked')==true) {
               $('#backup').iCheck('check');
            }else{
               $('#backup').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_entry').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_return_usage').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_import').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_adjust').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_move').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_delivery').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_return_delivery').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
			|| $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	$('#trash_stock_usage').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });

    $('#trash_request').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true
            || $('#trash_order').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });

    $('#trash_order').on('ifChanged',function(){
        if (this.checked) {
            $('#trash').iCheck('check');
        }else{
            if($('#trash_stock_entry').prop('checked')==true
            || $('#trash_stock_import').prop('checked')==true
            || $('#trash_stock_adjust').prop('checked')==true
            || $('#trash_stock_move').prop('checked')==true
            || $('#trash_stock_delivery').prop('checked')==true
            || $('#trash_stock_return_delivery').prop('checked')==true
            || $('#trash_stock_return_usage').prop('checked')==true
            || $('#trash_request').prop('checked')==true
            || $('#trash_stock_usage').prop('checked')==true) {
               $('#trash').iCheck('check');
            }else{
               $('#trash').iCheck('uncheck');
            }
        }
    });
	
	// ======================== End Syste Setting ==================== //
	
	$('#stock_entry').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_import').prop('checked')==true 
			|| $('#stock_adjust').prop('checked')==true 
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_balance').prop('checked')==true
			|| $('#delivery').prop('checked')==true
			|| $('#usage').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#stock_import').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_entry').prop('checked')==true 
			|| $('#stock_adjust').prop('checked')==true 
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_balance').prop('checked')==true
			|| $('#delivery').prop('checked')==true
			|| $('#usage').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#stock_adjust').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_import').prop('checked')==true 
			|| $('#stock_entry').prop('checked')==true 
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_balance').prop('checked')==true
			|| $('#delivery').prop('checked')==true
			|| $('#usage').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#stock_move').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_import').prop('checked')==true 
			|| $('#stock_adjust').prop('checked')==true 
			|| $('#stock_entry').prop('checked')==true
			|| $('#stock_balance').prop('checked')==true
			|| $('#delivery').prop('checked')==true
			|| $('#usage').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#stock_balance').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_import').prop('checked')==true 
			|| $('#stock_adjust').prop('checked')==true 
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_entry').prop('checked')==true
			|| $('#delivery').prop('checked')==true
			|| $('#usage').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#delivery').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_import').prop('checked')==true 
			|| $('#stock_adjust').prop('checked')==true 
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_balance').prop('checked')==true
			|| $('#stock_entry').prop('checked')==true
			|| $('#usage').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#usage').on('ifChanged',function(){
        if (this.checked) {
            $('#inventory').iCheck('check');
        }else{
            if ($('#stock_import').prop('checked')==true 
			|| $('#stock_adjust').prop('checked')==true 
			|| $('#stock_move').prop('checked')==true
			|| $('#stock_balance').prop('checked')==true
			|| $('#delivery').prop('checked')==true
			|| $('#stock_entry').prop('checked')==true) {
                $('#inventory').iCheck('check');
            }else{
                $('#inventory').iCheck('uncheck'); 
            }
        }
    });
	
	$('#stock_entry_add').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_entry').iCheck('check');
        }else{
            if($('#stock_entry_edit').prop('checked')==true
            || $('#stock_entry_delete').prop('checked')==true) {
               $('#stock_entry').iCheck('check');
            }else{
               $('#stock_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_entry_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_entry').iCheck('check');
        }else{
            if($('#stock_entry_add').prop('checked')==true
            || $('#stock_entry_delete').prop('checked')==true) {
               $('#stock_entry').iCheck('check');
            }else{
               $('#stock_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_entry_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_entry').iCheck('check');
        }else{
            if($('#stock_entry_edit').prop('checked')==true
            || $('#stock_entry_add').prop('checked')==true) {
               $('#stock_entry').iCheck('check');
            }else{
               $('#stock_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_import_add').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_import').iCheck('check');
        }else{
            if($('#stock_import_edit').prop('checked')==true
            || $('#stock_import_delete').prop('checked')==true) {
               $('#stock_import').iCheck('check');
            }else{
               $('#stock_import').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_import_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_import').iCheck('check');
        }else{
            if($('#stock_import_add').prop('checked')==true
            || $('#stock_import_delete').prop('checked')==true) {
               $('#stock_import').iCheck('check');
            }else{
               $('#stock_import').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_import_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_import').iCheck('check');
        }else{
            if($('#stock_import_edit').prop('checked')==true
            || $('#stock_import_add').prop('checked')==true) {
               $('#stock_import').iCheck('check');
            }else{
               $('#stock_import').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_adjust_add').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_adjust').iCheck('check');
        }else{
            if($('#stock_adjust_edit').prop('checked')==true
            || $('#stock_adjust_delete').prop('checked')==true) {
               $('#stock_adjust').iCheck('check');
            }else{
               $('#stock_adjust').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_adjust_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_adjust').iCheck('check');
        }else{
            if($('#stock_adjust_add').prop('checked')==true
            || $('#stock_adjust_delete').prop('checked')==true) {
               $('#stock_adjust').iCheck('check');
            }else{
               $('#stock_adjust').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_adjust_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_adjust').iCheck('check');
        }else{
            if($('#stock_adjust_edit').prop('checked')==true
            || $('#stock_adjust_add').prop('checked')==true) {
               $('#stock_adjust').iCheck('check');
            }else{
               $('#stock_adjust').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_move_add').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_move').iCheck('check');
        }else{
            if($('#stock_move_edit').prop('checked')==true
            || $('#stock_move_delete').prop('checked')==true) {
               $('#stock_move').iCheck('check');
            }else{
               $('#stock_move').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_move_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_move').iCheck('check');
        }else{
            if($('#stock_move_add').prop('checked')==true
            || $('#stock_move_delete').prop('checked')==true) {
               $('#stock_move').iCheck('check');
            }else{
               $('#stock_move').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_move_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_move').iCheck('check');
        }else{
            if($('#stock_move_edit').prop('checked')==true
            || $('#stock_move_add').prop('checked')==true) {
               $('#stock_move').iCheck('check');
            }else{
               $('#stock_move').iCheck('uncheck');
            }
        }
    });
	
	$('#stock_balance_view').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_balance').iCheck('check');
        }else{
            $('#stock_balance').iCheck('uncheck');
        }
    });
	
	$('#delivery_entry').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery').iCheck('check');
        }else{
            if($('#delivery_return').prop('checked')==true) {
               $('#delivery').iCheck('check');
            }else{
               $('#delivery').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_return').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery').iCheck('check');
        }else{
            if($('#delivery_entry').prop('checked')==true) {
               $('#delivery').iCheck('check');
            }else{
               $('#delivery').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_entry').on('ifChanged',function(){
        if (this.checked) {
            $('#usage').iCheck('check');
        }else{
            if($('#usage_return').prop('checked')==true) {
               $('#usage').iCheck('check');
            }else{
               $('#usage').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_return').on('ifChanged',function(){
        if (this.checked) {
            $('#usage').iCheck('check');
        }else{
            if($('#usage_entry').prop('checked')==true) {
               $('#usage').iCheck('check');
            }else{
               $('#usage').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_entry_add').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery_entry').iCheck('check');
        }else{
            if($('#delivery_entry_edit').prop('checked')==true
            || $('#delivery_entry_delete').prop('checked')==true) {
               $('#delivery_entry').iCheck('check');
            }else{
               $('#delivery_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_entry_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery_entry').iCheck('check');
        }else{
            if($('#delivery_entry_add').prop('checked')==true
            || $('#delivery_entry_delete').prop('checked')==true) {
               $('#delivery_entry').iCheck('check');
            }else{
               $('#delivery_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_entry_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery_entry').iCheck('check');
        }else{
            if($('#delivery_entry_edit').prop('checked')==true
            || $('#delivery_entry_add').prop('checked')==true) {
               $('#delivery_entry').iCheck('check');
            }else{
               $('#delivery_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_return_add').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery_return').iCheck('check');
        }else{
            if($('#delivery_return_edit').prop('checked')==true
            || $('#delivery_return_delete').prop('checked')==true) {
               $('#delivery_return').iCheck('check');
            }else{
               $('#delivery_return').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_return_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery_return').iCheck('check');
        }else{
            if($('#delivery_return_add').prop('checked')==true
            || $('#delivery_return_delete').prop('checked')==true) {
               $('#delivery_return').iCheck('check');
            }else{
               $('#delivery_return').iCheck('uncheck');
            }
        }
    });
	
	$('#delivery_return_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#delivery_return').iCheck('check');
        }else{
            if($('#delivery_return_edit').prop('checked')==true
            || $('#delivery_return_add').prop('checked')==true) {
               $('#delivery_return').iCheck('check');
            }else{
               $('#delivery_return').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_entry_add').on('ifChanged',function(){
        if (this.checked) {
            $('#usage_entry').iCheck('check');
        }else{
            if($('#usage_entry_edit').prop('checked')==true
            || $('#usage_entry_delete').prop('checked')==true) {
               $('#usage_entry').iCheck('check');
            }else{
               $('#usage_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_entry_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#usage_entry').iCheck('check');
        }else{
            if($('#usage_entry_add').prop('checked')==true
            || $('#usage_entry_delete').prop('checked')==true) {
               $('#usage_entry').iCheck('check');
            }else{
               $('#usage_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_entry_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#usage_entry').iCheck('check');
        }else{
            if($('#usage_entry_edit').prop('checked')==true
            || $('#usage_entry_add').prop('checked')==true) {
               $('#usage_entry').iCheck('check');
            }else{
               $('#usage_entry').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_return_add').on('ifChanged',function(){
        if (this.checked) {
            $('#usage_return').iCheck('check');
        }else{
            if($('#usage_return_edit').prop('checked')==true
            || $('#usage_return_delete').prop('checked')==true) {
               $('#usage_return').iCheck('check');
            }else{
               $('#usage_return').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_return_edit').on('ifChanged',function(){
        if (this.checked) {
            $('#usage_return').iCheck('check');
        }else{
            if($('#usage_return_add').prop('checked')==true
            || $('#usage_return_delete').prop('checked')==true) {
               $('#usage_return').iCheck('check');
            }else{
               $('#usage_return').iCheck('uncheck');
            }
        }
    });
	
	$('#usage_return_delete').on('ifChanged',function(){
        if (this.checked) {
            $('#usage_return').iCheck('check');
        }else{
            if($('#usage_return_edit').prop('checked')==true
            || $('#usage_return_add').prop('checked')==true) {
               $('#usage_return').iCheck('check');
            }else{
               $('#usage_return').iCheck('uncheck');
            }
        }
    });
	
	// ============================================================
	
	$('#stock_entry').on('ifChanged',function(){
        if (this.checked) {
            if($('#stock_entry_add').prop('checked')==true
            || $('#stock_entry_edit').prop('checked')==true
			|| $('#stock_entry_delete').prop('checked')==true) {}else{
				
                $('#stock_entry_add').iCheck('check');
                $('#stock_entry_edit').iCheck('check');
                $('#stock_entry_delete').iCheck('check');
            }
        }else{
            $('#stock_entry_add').iCheck('uncheck');
            $('#stock_entry_edit').iCheck('uncheck');
            $('#stock_entry_delete').iCheck('uncheck');
        }
    });
	
	$('#stock_import').on('ifChanged',function(){
        if (this.checked) {
            if($('#stock_import_add').prop('checked')==true
            || $('#stock_import_edit').prop('checked')==true
			|| $('#stock_import_delete').prop('checked')==true) {}else{
				
                $('#stock_import_add').iCheck('check');
                $('#stock_import_edit').iCheck('check');
                $('#stock_import_delete').iCheck('check');
            }
        }else{
            $('#stock_import_add').iCheck('uncheck');
            $('#stock_import_edit').iCheck('uncheck');
            $('#stock_import_delete').iCheck('uncheck');
        }
    });
	
	$('#stock_adjust').on('ifChanged',function(){
        if (this.checked) {
            if($('#stock_adjust_add').prop('checked')==true
            || $('#stock_adjust_edit').prop('checked')==true
			|| $('#stock_adjust_delete').prop('checked')==true) {}else{
				
                $('#stock_adjust_add').iCheck('check');
                $('#stock_adjust_edit').iCheck('check');
                $('#stock_adjust_delete').iCheck('check');
            }
        }else{
            $('#stock_adjust_add').iCheck('uncheck');
            $('#stock_adjust_edit').iCheck('uncheck');
            $('#stock_adjust_delete').iCheck('uncheck');
        }
    });
	
	$('#stock_move').on('ifChanged',function(){
        if (this.checked) {
            if($('#stock_move_add').prop('checked')==true
            || $('#stock_move_edit').prop('checked')==true
			|| $('#stock_move_delete').prop('checked')==true) {}else{
				
                $('#stock_move_add').iCheck('check');
                $('#stock_move_edit').iCheck('check');
                $('#stock_move_delete').iCheck('check');
            }
        }else{
            $('#stock_move_add').iCheck('uncheck');
            $('#stock_move_edit').iCheck('uncheck');
            $('#stock_move_delete').iCheck('uncheck');
        }
    });
	
	$('#delivery_entry').on('ifChanged',function(){
        if (this.checked) {
            if($('#delivery_entry_add').prop('checked')==true
            || $('#delivery_entry_edit').prop('checked')==true
			|| $('#delivery_entry_delete').prop('checked')==true) {}else{
				
                $('#delivery_entry_add').iCheck('check');
                $('#delivery_entry_edit').iCheck('check');
                $('#delivery_entry_delete').iCheck('check');
            }
        }else{
            $('#delivery_entry_add').iCheck('uncheck');
            $('#delivery_entry_edit').iCheck('uncheck');
            $('#delivery_entry_delete').iCheck('uncheck');
        }
    });
	
	$('#delivery_return').on('ifChanged',function(){
        if (this.checked) {
            if($('#delivery_return_add').prop('checked')==true
            || $('#delivery_return_edit').prop('checked')==true
			|| $('#delivery_return_delete').prop('checked')==true) {}else{
				
                $('#delivery_return_add').iCheck('check');
                $('#delivery_return_edit').iCheck('check');
                $('#delivery_return_delete').iCheck('check');
            }
        }else{
            $('#delivery_return_add').iCheck('uncheck');
            $('#delivery_return_edit').iCheck('uncheck');
            $('#delivery_return_delete').iCheck('uncheck');
        }
    });
	
	$('#usage_entry').on('ifChanged',function(){
        if (this.checked) {
            if($('#usage_entry_add').prop('checked')==true
            || $('#usage_entry_edit').prop('checked')==true
			|| $('#usage_entry_delete').prop('checked')==true) {}else{
				
                $('#usage_entry_add').iCheck('check');
                $('#usage_entry_edit').iCheck('check');
                $('#usage_entry_delete').iCheck('check');
            }
        }else{
            $('#usage_entry_add').iCheck('uncheck');
            $('#usage_entry_edit').iCheck('uncheck');
            $('#usage_entry_delete').iCheck('uncheck');
        }
    });

	$('#usage_return').on('ifChanged',function(){
        if (this.checked) {
            if($('#usage_return_add').prop('checked')==true
            || $('#usage_return_edit').prop('checked')==true
			|| $('#usage_return_delete').prop('checked')==true) {}else{
				
                $('#usage_return_add').iCheck('check');
                $('#usage_return_edit').iCheck('check');
                $('#usage_return_delete').iCheck('check');
            }
        }else{
            $('#usage_return_add').iCheck('uncheck');
            $('#usage_return_edit').iCheck('uncheck');
            $('#usage_return_delete').iCheck('uncheck');
        }
    });
	
	$('#stock_balance').on('ifChanged',function(){
        if (this.checked) {
            $('#stock_balance_view').iCheck('check');
        }else{
			$('#stock_balance_view').iCheck('uncheck');
        }
    });
	
	// ======================== End Inventory ======================== //