<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'indexControllers';
$route['404_override'] = 'indexControllers/notfound';
$route['translate_uri_dashes'] = FALSE;
//home
$route['danh-muc/(:any)']['GET'] = 'indexControllers/danhmuc/$1';
$route['san-pham/(:any)']['GET'] = 'indexControllers/monan/$1';
$route['gio-hang']['GET'] = 'indexControllers/giohang';
$route['them-gio-hang']['POST'] = 'indexControllers/them_gio_hang';
$route['cap-nhat-gio-hang']['POST'] = 'indexControllers/cap_nhat_gio_hang';
$route['xoa-tat-ca']['GET'] = 'indexControllers/xoa_tat_ca';
$route['xoa-don-hang/(:any)']['GET'] = 'indexControllers/xoa_don_hang/$1';
$route['dang-nhap']['GET'] = 'indexControllers/login';
$route['checkout']['GET'] = 'indexControllers/checkout';
$route['online-checkout']['POST'] = 'OnlineCheckout/online_checkout';
//liên hệ 
$route['lienhe']['GET'] = 'indexControllers/lienhe';
$route['gui-lienhe']['POST'] = 'indexControllers/gui_lienhe';

//xác nhận đặt hàng
$route['xacnhan-dathang']['POST'] = 'indexControllers/xacnhan_dathang';
//
$route['danh-muc/(:any)/(:any)']['GET'] = 'indexControllers/danhmuc/$1/$2';
// trang cảm ơn
$route['cam_on']['GET'] = 'indexControllers/cam_on';
//đăng xuất khách hàng
$route['dang-xuat']['GET'] = 'indexControllers/dang_xuat';
//tìm kiếm 
$route['tim-kiem']['GET'] = 'indexControllers/tim_kiem';
//phân trang tìm kiếm 
$route['tim-kiem/(:num)']['GET'] = 'indexControllers/tim_kiem/$1';
//phân trang
$route['phan-trang/index/(:num)'] = 'indexControllers/index/$1';
$route['phan-trang/index'] = 'indexControllers/index/';

//đăng nhập
$route['login']['GET'] = 'DangNhapControllers/index';
$route['login-user']['POST'] = 'DangNhapControllers/login';
//đăng nhập khách hàng
$route['dangnhap-khachhang']['POST'] = 'indexControllers/dangnhap_khachhang';
//đăng ký
$route['dang-ky']['POST'] = 'indexControllers/dang_ky';
//xác thực đăng ký
$route['xac-thuc-dang-ky']['GET'] = 'indexControllers/xac_thuc_dang_ky';

//Dashboard 
$route['dashboard']['GET'] = 'DanshboardContollers/index';
//Đăng ký admin
$route['dang-ky-admin']['GET'] = 'DangNhapControllers/dang_ky_admin';
$route['dang-ky-thanh-vien']['POST'] = 'DangNhapControllers/dang_ky_thanh_vien';

//LogOut
$route['logout']['GET'] = 'DanshboardContollers/logout';
//COMBO
$route['combo/add']['GET'] = 'ComBoControllers/add';
$route['combo/list']['GET'] = 'ComBoControllers/index';
$route['combo/delete/(:any)']['GET'] = 'ComBoControllers/delete/$1';
$route['combo/edit/(:any)']['GET'] = 'ComBoControllers/edit/$1'; //any: bất kỳ dữ liệu nào, $1: là trã giá trị về phương thức edit
$route['combo/update/(:any)']['POST'] = 'ComBoControllers/update/$1';
$route['combo/store']['POST'] = 'ComBoControllers/store';

//Thanh Trượt slider
$route['thanh_truot/add']['GET'] = 'Thanh_TruotControllers/add';
$route['thanh_truot/list']['GET'] = 'Thanh_TruotControllers/index';
$route['thanh_truot/delete/(:any)']['GET'] = 'Thanh_TruotControllers/delete/$1';
$route['thanh_truot/edit/(:any)']['GET'] = 'Thanh_TruotControllers/edit/$1'; //any: bất kỳ dữ liệu nào, $1: là trã giá trị về phương thức edit
$route['thanh_truot/update/(:any)']['POST'] = 'Thanh_TruotControllers/update/$1';
$route['thanh_truot/store']['POST'] = 'Thanh_TruotControllers/store';

//Món Ăn
$route['monan/add']['GET'] = 'MonAnControllers/add';
$route['monan/list']['GET'] = 'MonAnControllers/index';
$route['monan/delete/(:any)']['GET'] = 'MonAnControllers/delete/$1';
$route['monan/edit/(:any)']['GET'] = 'MonAnControllers/edit/$1'; //any: bất kỳ dữ liệu nào, $1: là trã giá trị về phương thức edit
$route['monan/update/(:any)']['POST'] = 'MonAnControllers/update/$1';
$route['monan/store']['POST'] = 'MonAnControllers/store';

//phân trang món ăn
$route['phan-trang-monan/list/(:num)'] = 'MonAnControllers/index/$1';
$route['phan-trang-monan/list'] = 'MonAnControllers/index';
//gởi gamil
$route['test-email'] = 'indexControllers/gui_email';
//chi tiết
$route['monan/chitiet/(:any)']['GET'] = 'MonAnControllers/chitiet/$1';
$route['monan/chitiet_monan/(:any)']['GET'] = 'MonAnControllers/chitiet_monan/$1';
//quản lý đơn hàng
$route['donhang/list']['GET'] = 'DonHangControllers/index';
$route['donhang/view/(:any)']['GET'] = 'DonHangControllers/view/$1';
$route['donhang/delete/(:any)']['GET'] = 'DonHangControllers/delete_donhang/$1';

// xử lý đơn hàng
$route['donhang/xuly']['POST'] = 'DonHangControllers/xuly';

//In đơn hàng 
// $route['donhang/in_donhang/(:any)']['GET'] = 'DonHangControllers/in_donhang/$1';

//bình luận 
$route['binhluan/gui_binhluan']['POST'] = 'indexControllers/guibinhluan';
