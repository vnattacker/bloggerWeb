<?

function GetFieldName($input){
    $defaults = "";
    switch($input){
					case "id":
						$defaults = "STT";
						break;
					case "ten_mat_hang":
						$defaults = "Tên Mặt Hàng";
						break;
					case "so_luong":
						$defaults = "Số Lượng";
						break;
					case "don_gia":
						$defaults = "Đơn Giá";
						break;
					case "don_vi":
						$defaults = "Đơn Vị";
						break;
					case "hinh_thuc":
						$defaults = "Hình Thức";
						break;
          case "ngay_ban":
            $defaults = "Ngày Bán";
            break;

          case "thanh_tien":
            $defaults = "Thành Tiền";
            break;
          case "tong_tien":
            $defaults = "Tổng Tiền";
            break;
          case "nguoi_nhap":
            $defaults = "Người Nhập";
            break;
          case "ngay_nhap":
            $defaults = "Ngày Nhập";
            break;
            case "ngay_mua":
                $defaults = "Ngày Mua";
                break;
            case "nguoi_mua":
                $defaults = "Người Mua";
                break;
            case "so_cong_to_thang_truoc":
                $defaults = "Số công tơ tháng trước";
                break;
            case "so_cong_to_thang_sau":
                $defaults = "Số công tơ tháng sau";
                break;
            case "tu_ngay_den_ngay":
                $defaults = "Từ ngày đến ngày";
                break;
                
            case "so_cong_to_thang_sau":
                $defaults = "Số công tơ tháng sau";
                 break;
            case "tu_ngay_den_ngay":
                $defaults = "Từ ngày đến ngày";
                break;
            case "thanh_tien":
            $defaults = "Thành tiền";
            break;
            case "ngay_dong":
                $defaults = "Ngày đóng";
                break;	
            
            case "nguoi_dong":
                $defaults = "Người đóng";
                break;	
            default:
                $defaults = "Không xác định";
                break;
        }
        return $defaults;
}
function GetTableName($input){
    $default = "";
    switch($input){
					case "BanNuocMia":
						$default = "Bán Nước";
						break;
					case "NhapMia":
						$default = "Nhập Mía";
						break;
					case "NhapDa":
						$default = "Nhập Đá";
						break;
					case "NhapQuat":
						$default = "Nhập Quất (Tắc)";
						break;
					case "ChiTieu":
						$default = "Chi Tiêu";
						break;
					case "TienDienNuoc":
						$default = "Tiền Điện/Nước";
						break;
				
					default:
						$default = "Không xác định";
						break;
				}
    return $default;
}
?>