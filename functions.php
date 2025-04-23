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
            case "ten":
            $defaults = "Tên";
            break;	
            case "NganSachHienTai":
            $defaults = "Ngân sách hiện tại";
            break;	
            case "loaisp":
            $defaults = "Loại SP: Bún/Mỳ/Cơm Hến";
            break;
            case "nguoighi":
            $defaults = "Người thêm";
            break;
            case "nguoisua":
            $defaults = "Người sửa";
            break;
            default:
                $defaults = "Dữ liệu Không xác định";
                break;
        }
        return $defaults;
}
function GetTableName($input){
    $default = "";
    switch($input){	case "bunhen":
						$default = "Bán Bún, Mỳ,Cơm Hến";
						break;
					case "bannuocmia":
						$default = "Bán Nước";
						break;
					case "nhapmia":
						$default = "Nhập Mía";
						break;
					case "nhapda":
						$default = "Nhập Đá";
						break;
					case "nhapquat":
						$default = "Nhập Quất (Tắc)";
						break;
					case "chitieu":
						$default = "Chi Tiêu";
						break;
					case "tiendiennuoc":
						$default = "Tiền Điện/Nước";
						break;
                    case "ngansachcuatoi":
                    $default = "Ngân Sách Của Tôi";
                    break;
					default:
						$default = "Bảng Không xác định";
						break;
				}
    return $default;
}

function DateField($field_name){
    switch($field_name){
        case "bannuocmia":
            return "ngay_ban";
        case "nhapmia":
            return "ngay_nhap";
        case "nhapda":
            return "ngay_nhap";
        case "nhapquat":
            return "ngay_nhap";
        case "chitieu":
            return "ngay_mua";
        case "tiendiennuoc":
            return "ngay_dong";
        case "ngansachcuatoi":
            return "ngay_nhap";
    
        default:
            return "ngay_ban";
    }
}
function executeQuery($conn, $sql) {
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row ? array_values($row)[0] : 0;
    } else {
        return 0;
    }
}

function ranClr(){
    $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    echo $colors[array_rand($colors)];
}
?>