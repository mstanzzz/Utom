<?php

	


	if(isset($_GET['intro'])) $_SESSION['temp_page_fields']['intro'] = $_GET['intro'];

	if(isset($_GET['content'])) $_SESSION['temp_page_fields']['content'] = $_GET['content'];
	if(isset($_GET['content_short1'])) $_SESSION['temp_page_fields']['content_short1'] = $_GET['content_short1'];
	if(isset($_GET['name'])) $_SESSION['temp_page_fields']['name'] = $_GET['name'];
	if(isset($_GET['display_order'])) $_SESSION['temp_page_fields']['display_order'] = $_GET['display_order'];
	if(isset($_GET['description'])) $_SESSION['temp_page_fields']['description'] = $_GET['description'];
	if(isset($_GET['spec_cat_id'])) $_SESSION['temp_page_fields']['spec_cat_id'] = $_GET['spec_cat_id'];
	if(isset($_GET['sidebar_heading'])) $_SESSION['temp_page_fields']['sidebar_heading'] = $_GET['sidebar_heading'];
	if(isset($_GET['sidebar_content'])) $_SESSION['temp_page_fields']['sidebar_content'] = $_GET['sidebar_content'];
	if(isset($_GET['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $_GET['img_alt_text'];
	
	if(isset($_GET['button_text'])) $_SESSION['temp_istallation_link_fields']['button_text'] = $_GET['button_text'];
	if(isset($_GET['page_seo_id'])) $_SESSION['temp_istallation_link_fields']['page_seo_id'] = $_GET['page_seo_id'];
	if(isset($_GET['color'])) $_SESSION['temp_istallation_link_fields']['color'] = $_GET['color'];	
	if(isset($_GET['local_url'])) $_SESSION['temp_istallation_link_fields']['local_url'] = $_GET['local_url'];

	if(isset($_GET['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $_GET['page_heading'];
	if(isset($_GET['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $_GET['seo_name'];
	
	if(isset($_GET['title'])) $_SESSION['temp_page_fields']['title'] = $_GET['title'];
	if(isset($_GET['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $_GET['keywords'];
	if(isset($_GET['description'])) $_SESSION['temp_page_fields']['description'] = $_GET['description'];
	
	if(isset($_GET['costco_title'])) $_SESSION['temp_page_fields']['costco_title'] = $_GET['costco_title'];
	if(isset($_GET['costco_keywords'])) $_SESSION['temp_page_fields']['costco_keywords'] = $_GET['costco_keywords'];
	if(isset($_GET['costco_description'])) $_SESSION['temp_page_fields']['costco_description'] = $_GET['costco_description'];
	
	// Home page
	if(isset($_GET['content_short2'])) $_SESSION['temp_page_fields']['content_short2'] = $_GET['content_short2'];
	if(isset($_GET['content_short3'])) $_SESSION['temp_page_fields']['content_short3'] = $_GET['content_short3'];
		
	if(isset($_GET['link_1_page_seo_id'])) $_SESSION['temp_page_fields']['link_1_page_seo_id'] = $_GET['link_1_page_seo_id'];
	if(isset($_GET['link_1_label'])) $_SESSION['temp_page_fields']['link_1_label'] = $_GET['link_1_label'];
	if(isset($_GET['p_right_head_text'])) $_SESSION['temp_page_fields']['p_right_head_text'] = $_GET['p_right_head_text'];
	if(isset($_GET['p_right_content_type'])) $_SESSION['temp_page_fields']['p_right_content_type'] = $_GET['p_right_content_type'];
		
	if(isset($_GET['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $_GET['img_alt_text'];
	if(isset($_GET['img_1_alt_text'])) $_SESSION['temp_page_fields']['img_1_alt_text'] = $_GET['img_1_alt_text'];

	if(isset($_GET['shop_by_heading1'])) $_SESSION['temp_page_fields']['shop_by_heading1'] = $_GET['shop_by_heading1'];
	if(isset($_GET['shop_by_heading2'])) $_SESSION['temp_page_fields']['shop_by_heading2'] = $_GET['shop_by_heading2'];
	
	if(isset($_GET['costco_shop_by_heading1'])) $_SESSION['temp_page_fields']['costco_shop_by_heading1'] = $_GET['costco_shop_by_heading1'];
	if(isset($_GET['costco_shop_by_heading2'])) $_SESSION['temp_page_fields']['costco_shop_by_heading2'] = $_GET['costco_shop_by_heading2'];
	
	if(isset($_GET['content_heading'])) $_SESSION['temp_page_fields']['content_heading'] = $_GET['content_heading'];
	if(isset($_GET['content_heading_url'])) $_SESSION['temp_page_fields']['content_heading_url'] = $_GET['content_heading_url'];
	if(isset($_GET['content_heading_page_seo_id'])) $_SESSION['temp_page_fields']['content_heading_page_seo_id'] = $_GET['content_heading_page_seo_id'];

	if(isset($_GET['design_fax_number'])) $_SESSION['temp_page_fields']['design_fax_number'] = $_GET['design_fax_number'];
	if(isset($_GET['download_form_file_id'])) $_SESSION['temp_page_fields']['download_form_file_id'] = $_GET['download_form_file_id'];
	if(isset($_GET['form_img_id'])) $_SESSION['temp_page_fields']['form_img_id'] = $_GET['form_img_id'];

	if(isset($_GET['banner_rotate'])) $_SESSION['temp_page_fields']['banner_rotate'] = $_GET['banner_rotate'];
	if(isset($_GET['banner_random'])) $_SESSION['temp_page_fields']['banner_random'] = $_GET['banner_random'];

	if(isset($_GET['p_right_head_content_type'])) $_SESSION['temp_page_fields']['p_right_head_content_type'] = $_GET['p_right_head_content_type'];


	if(isset($_GET['support_phone'])) $_SESSION['temp_page_fields']['support_phone'] = $_GET['support_phone'];
	if(isset($_GET['support_fax'])) $_SESSION['temp_page_fields']['support_fax'] = $_GET['support_fax'];
	if(isset($_GET['support_hours'])) $_SESSION['temp_page_fields']['support_hours'] = $_GET['support_hours'];
	if(isset($_GET['chat_url'])) $_SESSION['temp_page_fields']['chat_url'] = $_GET['chat_url'];
	if(isset($_GET['chat_account'])) $_SESSION['temp_page_fields']['chat_account'] = $_GET['chat_account'];
	if(isset($_GET['chat_show'])) $_SESSION['temp_page_fields']['chat_show'] = $_GET['chat_show'];
	
	
	if(isset($_GET['support_email'])) $_SESSION['temp_page_fields']['support_email'] = $_GET['support_email'];
	if(isset($_GET['show_faq_link'])) $_SESSION['temp_page_fields']['show_faq_link'] = $_GET['show_faq_link'];
	if(isset($_GET['show_social_media_links'])) $_SESSION['temp_page_fields']['show_social_media_links'] = $_GET['show_social_media_links'];
	if(isset($_GET['facebook_url'])) $_SESSION['temp_page_fields']['facebook_url'] = $_GET['facebook_url'];
	if(isset($_GET['twitter_url'])) $_SESSION['temp_page_fields']['twitter_url'] = $_GET['twitter_url'];


	if(isset($_GET['video_img_id'])) $_SESSION['temp_page_fields']['video_img_id'] = $_GET['video_img_id'];
	if(isset($_GET['start_design_img_id'])) $_SESSION['temp_page_fields']['start_design_img_id'] = $_GET['start_design_img_id'];
	if(isset($_GET['specs_img_id'])) $_SESSION['temp_page_fields']['specs_img_id'] = $_GET['specs_img_id'];
	if(isset($_GET['cat_1_id'])) $_SESSION['temp_page_fields']['cat_1_id'] = $_GET['cat_1_id'];
	if(isset($_GET['cat_2_id'])) $_SESSION['temp_page_fields']['cat_2_id'] = $_GET['cat_2_id'];
	if(isset($_GET['cat_3_id'])) $_SESSION['temp_page_fields']['cat_3_id'] = $_GET['cat_3_id'];
	if(isset($_GET['cat_4_id'])) $_SESSION['temp_page_fields']['cat_4_id'] = $_GET['cat_4_id'];
	if(isset($_GET['url_name'])) $_SESSION['temp_page_fields']['url_name'] = $_GET['url_name'];
	if(isset($_GET['meta_title'])) $_SESSION['temp_page_fields']['meta_title'] = $_GET['meta_title'];
	if(isset($_GET['meta_keywords'])) $_SESSION['temp_page_fields']['meta_keywords'] = $_GET['meta_keywords'];
	if(isset($_GET['meta_description'])) $_SESSION['temp_page_fields']['meta_description'] = $_GET['meta_description'];

	
	if(isset($_GET['heading'])) $_SESSION['temp_page_fields']['heading'] = $_GET['heading'];
	if(isset($_GET['sub_heading'])) $_SESSION['temp_page_fields']['sub_heading'] = $_GET['sub_heading'];
	
	if(isset($_GET['url_name'])) $_SESSION['temp_page_fields']['url_name'] = $_GET['url_name'];	
	
	if(isset($_GET['videos_btn_text'])) $_SESSION['temp_page_fields']['videos_btn_text'] = $_GET['videos_btn_text'];
	if(isset($_GET['design_btn_text'])) $_SESSION['temp_page_fields']['design_btn_text'] = $_GET['design_btn_text'];
	if(isset($_GET['specs_btn_text'])) $_SESSION['temp_page_fields']['specs_btn_text'] = $_GET['specs_btn_text'];
	if(isset($_GET['cat_1_btn_text'])) $_SESSION['temp_page_fields']['cat_1_btn_text'] = $_GET['cat_1_btn_text'];
	if(isset($_GET['cat_2_btn_text'])) $_SESSION['temp_page_fields']['cat_2_btn_text'] = $_GET['cat_2_btn_text'];
	if(isset($_GET['cat_3_btn_text'])) $_SESSION['temp_page_fields']['cat_3_btn_text'] = $_GET['cat_3_btn_text'];
	if(isset($_GET['cat_4_btn_text'])) $_SESSION['temp_page_fields']['cat_4_btn_text'] = $_GET['cat_4_btn_text'];

	if(isset($_GET['show_on_home_page'])) $_SESSION['temp_page_fields']['show_on_home_page'] = $_GET['show_on_home_page'];
	
	
	if(isset($_GET['shop_by_cat_location'])) $_SESSION['temp_page_fields']['shop_by_cat_location'] = $_GET['shop_by_cat_location'];
	if(isset($_GET['shop_by_sr_location'])) $_SESSION['temp_page_fields']['shop_by_sr_location'] = $_GET['shop_by_sr_location'];
	if(isset($_GET['kwlp_location'])) $_SESSION['temp_page_fields']['kwlp_location'] = $_GET['kwlp_location'];
	if(isset($_GET['kwlp_heading'])) $_SESSION['temp_page_fields']['kwlp_heading'] = $_GET['kwlp_heading'];
	
	if(isset($_GET['to_cust_email_body'])) $_SESSION['temp_page_fields']['to_cust_email_body'] = $_GET['to_cust_email_body'];
	
	
	
	
	
	

?>