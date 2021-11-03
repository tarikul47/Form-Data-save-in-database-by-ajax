
add_action('wp_ajax_constact_us', 'ajax_conatct_us');
function ajax_conatct_us()
{

	$data1 = [];
	wp_parse_str($_POST['fData'], $data1);

	global $wpdb;
	global $table_prefix;
	$table = '_contact_us';

	$result = $wpdb->insert( $table, [
		"name" => $data1['name'],
		"email" => $data1['email']
	]);

	$name = $data1['name'];
	$email = $data1['email'];

	if($result>0){
		wp_send_json_success("Data inserted");
	}else{
		wp_send_json_error("Please try again");
	}
}
