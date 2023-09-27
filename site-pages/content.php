<?php
if (empty($_GET['page_name'])) {
	header("Location: " . UrlLink(''));
    exit();
}

$ask->page_data = $db->where('page_name',Secure($_GET['page_name']))->getOne(T_CUSTOM_PAGES);
if (empty($ask->page_data)) {
	header("Location: " . UrlLink(''));
	exit();
}
$arr = array('SIDEBAR_FOOTER'    => LoadPage('timeline/partials/sidebar_footer', [
        'ACTIVE_LANG'       => $ask->language,
        'ACTIVE_LANGNAME'   => ucfirst($ask->language),
        'LANGS_RIGHT'       => GetLang(true),
        'LANGS_LEFT'        => GetLang(false)
    ]));
$ask->page_url_ = $ask->config->site_url.'/custom_page';
$ask->page        = 'custom_page';
$ask->title       = $ask->page_data->page_title . ' | ' . $ask->config->title;
$ask->description = $ask->config->description;
$ask->keyword     = $ask->config->keyword;
$ask->content     = LoadPage('custom_page/content',$arr);