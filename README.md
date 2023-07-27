# Vaccination-Management-web
# Vaccination-Management-window-app-
HỆ THỐNG QUẢN LÝ TIÊM CHỦNG VACCINE COVID-19
1. Phát biểu bài toán
Chính phủ và Bộ Y tế đã và đang triển khai kế hoạch tiêm chủng vaccine phòng Covid-19 toàn dân từ giữa năm 2021 đến nay. Đây là một kế hoạch với quy mô lớn toàn quốc, đòi hỏi sự quản lý chặt chẽ về thông tin cá nhân của công dân, thông tin sức khỏe của công dân, thông tin các đơn vị tổ chức tiêm chủng, thông tin các lịch tiêm chủng, thông tin đăng ký tiêm chủng của công dân, thông tin các mũi tiêm vaccine Covid-19 của công dân,… Để đảm bảo tất cả những công việc này được thực hiện một cách chuẩn xác nhất thì cần phải có một hệ thống cơ sở dữ liệu tầm cỡ quốc gia để lưu trữ, xử lý các thông tin cần thiết trên.
Trước đây, việc tổ chức tiêm chủng, lưu trữ các thông tin đều được thực hiện trên giấy tờ. Cách tổ chức này còn phức tạp, không đảm bảo chặt chẽ được các giai đoạn trong quá trình tiêm chủng và xử lý thông tin. Vì vậy, Chính phủ cần phát triển một hệ thống để giao cho Bộ Y tế quản lí việc tiêm chủng vaccine Covid-19 toàn dân. Hệ thống này cho phép Bộ Y tế, các đơn vị tổ chức tiêm chủng, công dân truy cập vào bằng cách đăng nhập và sử dụng với các quyền truy cập khác nhau. Bộ Y tế có khả năng cấp tài khoản cho các đơn vị tiêm chủng, ban hành thông tin về các loại vaccine cũng như thông tin về các quy định của mũi tiêm, tra cứu thông tin tiêm chủng của công dân, thống kê và cập nhật số liệu tiêm chủng trên toàn quốc. Các đơn vị tổ chức tiêm chủng tại các địa phương được Bộ Y tế cấp tài khoản để sử dụng hệ thống để đăng ký thông tin cho đơn vị của mình, và có quyền thiết lập và quản lý các lịch tiêm chủng tại địa phương của đơn vị để công dân có thể đăng ký tiêm chủng, ban hành các thông tin liên quan, ngoài ra các đơn vị còn có thể tra cứu thông tin tiêm chủng cũng như cập nhật thông tin mũi tiêm của các công dân đã đăng ký tiêm chủng tại đơn vị của mình. Công dân sử dụng hệ thống này để đăng ký và cập nhật thông tin cá nhân, khai báo y tế để phục vụ cho việc đăng ký tiêm chủng. Mọi công dân khi đã đủ điều kiện tiêm chủng đều có thể đăng ký tiêm chủng tại các đơn vị có lịch tiêm chủng mà họ mong muốn. Ngoài ra, công dân còn có thể tra cứu các thông tin mũi tiêm vaccine của bản thân, thông tin chứng nhận Covid-19 và thông tin do Bộ Y tế hoặc các đơn vị tiêm chủng tại địa phương ban hành.

2. Quy trình nghiệp vụ
* Quy trình cấp tài khoản cho các đơn vị tiêm chủng:
Bộ Y tế thực hiện cấp tài khoản đăng nhập hàng loạt hoặc đơn lẻ cho từng khu vực. Các tài khoản được Bộ Y tế tạo và cung cấp sẽ bao gồm Mã đơn vị tiêm chủng, thông tỉnh trực thuộc của đơn vị mà Bộ chọn để cấp tài khoản. Những tài khoản này được phân phối về từng địa phương cấp tỉnh, địa phương cấp tỉnh tiếp tục phân phối các tài khoản này đến các cấp thấp hơn. Các tài khoản được phân phối đến từng đơn vị có khả năng tổ chức tiêm chủng.
* Quy trình ban hành văn bản thông tin:
Bộ Y tế ban hành các văn bản thông tin về vaccine, quy định các mũi tiêm, số liệu trong tiêm chủng vaccine Covid-19. Công dân toàn quốc luôn xem được các thông tin mới nhất từ Bộ Y tế ban hành.
Các đơn vị tiêm chủng ban hành các thông tin liên quan đến đơn vị của mình. Công dân sinh sống trong khu vực của các đơn vị này có thể xem được các thông tin do các đơn vị đó ban hành.
* Quy trình thiết lập thông tin đơn vị tổ chức tiêm chủng:
Các trạm y tế, bệnh viện, cơ sở khám chữa bệnh hay trạm tiêm chủng lưu động do một tổ chức nào đó quản lý tại các địa phương có quyền tổ chức tiêm chủng sẽ được Bộ Y tế cấp cho tài khoản đăng nhập. Đơn vị thực hiện cập nhật thông tin cho đơn vị của mình vào tài khoản được cấp. Các đơn vị tổ chức tiêm chủng này được cấp quyền thiết lập các lịch tiêm chủng do đơn vị mình quản lý.
* Quy trình đăng ký thông tin của công dân:
Mỗi công dân đăng ký tài khoản bằng số điện thoại cá nhân và điền các thông  tin cá nhân như CMND/CCCD, họ tên, giới tính, ngày sinh, quê quán, địa chỉ, số điện thoại liên lạc, email,… để có thể thực hiện đăng ký tiêm chủng.
* Quy trình xem văn bản thông tin:
Mỗi công dân có thể xem các thông tin văn bản được ban hành từ Bộ Y tế và các đơn vị tiêm chủng trong khu vực
* Quy trình thiết lập lịch tiêm chủng:
Mỗi đơn vị tổ chức tiêm chủng được phép tổ chức tiêm chủng khi đơn vị đó được cấp các lô vaccine. Thời gian và địa điểm tiêm chủng do đơn vị quản lý, thiết lập và bố trí. Trong một ngày của mỗi lịch tiêm có thể có ba buổi tiêm là sáng, trưa và tối. Với mỗi buổi, tùy theo sức chứa của địa điểm tiêm, đơn vị quản lý sẽ thiết lập giới hạn số lượng người đăng ký cho mỗi buổi để đảm bảo tuân thủ các quy định về phòng chống dịch tại nơi công cộng tập trung đông người, cũng như đảm bảo khả năng tổ chức và quản lý.
Lịch tiêm chủng cập nhật liên tục số lượng người đã đăng ký ở mỗi buổi, khi số lượng đăng ký đạt giới hạn ở buổi nào thì không thể đăng ký tiêm chủng ở buổi đó nữa.
* Quy trình khai báo y tế:
Để đảm bảo về sức khỏe của công dân trong việc tiêm chủng thì cần phải khám sàng lọc sức khỏe công dân trước khi tiêm. Để giảm tải thời gian khám sàn lọc tại địa điểm tiêm, công dân nên thực hiện khai báo y tế trên hệ thống.
Đối tượng cần trì hoãn tiêm chủng, hoặc đối tượng chống chỉ định tiêm chủng, hoặc đối tượng đang dương tính với Covid-19 thì không thể đăng ký tiêm chủng.
Đối tượng đã khỏi bệnh Covid-19, có chứng nhận khỏi bệnh/hoàn thành cách ly được cấp từ đơn vị cách ly thì có thể khai báo tình trạng sức khỏe thành âm tính. Khi tình trạng sức khỏe cuối cùng được khai báo là âm tính và không còn là đối tượng trì hoãn tiêm chủng thì đối tượng đó có thể đăng ký tiêm chủng bình thường.
* Quy trình đăng ký tiêm chủng:
Để đăng ký tiêm chủng, công dân chọn tỉnh/thành, quận/huyện, xã/phường/thị trấn nơi mình đang ở (hoặc nơi khác) để hệ thống cung cấp thông tin về các đơn vị tổ chức tiêm chủng có trong khu vực. Tiếp theo, chọn một đơn vị, hệ thống sẽ cung cấp danh sách các lịch tiêm đang sẵn có của đơn vị đã chọn. Mỗi lịch tiêm hiển thị số lượng giới hạn đăng ký và số lượng người đã đăng ký ở mỗi buổi. Chọn một lịch tiêm, sau đó chọn buổi tiêm (sáng hoặc chiều).
Công dân không thể đăng ký tiêm chủng nếu: 
+ Nếu lịch tiêm được chọn đã đạt số lượng giới hạn người đăng ký.
+ Nếu khoảng cách thời gian giữa mũi tiêm trước và mũi tiêm tiếp theo của đối tượng đăng ký chưa hợp lệ (nếu có), hoặc loại vaccine Covid-19 không phù hợp với mũi tiêm trước (nếu có).
+ Nếu đối tượng đăng ký là đối tượng cần trì hoãn tiêm chủng, hoặc là đối tượng chống chỉ định tiêm chủng, hoặc đang dương tính với Covid-19.
Khi đăng ký thành công, hệ thống sẽ lưu lại lịch đăng ký gồm các thông tin cơ bản của đối tượng đăng ký tiêm chủng, trạng thái lịch đăng ký tiêm chủng của đối tượng đó sẽ hiển thị là "đã đăng ký".
Khi đăng ký thất bại thì hệ thống sẽ thông báo đăng ký thất bại và không ghi nhận lại thông tin đăng ký.
Mỗi đối tượng chỉ có thể có duy nhất một lịch đăng ký tiêm chủng có trạng thái là "đã đăng ký" hoặc “điểm danh” để đảm bảo khoảng cách thời gian giữa các mũi tiêm.
Công dân cũng có thể tự hủy lịch đăng ký tiêm chủng trước khi ngày tiêm bắt đầu, trạng thái lịch đăng ký cũng sẽ chuyển sang "đã hủy".
Số lượng người đăng ký tiêm chủng của mỗi lịch tiêm sẽ được cập nhật mỗi khi có một đối tượng mới đăng ký hoặc hủy đăng ký.
* Quy trình tiêm chủng:
Công dân đã đăng ký tiêm chủng thành công thì đến địa điểm tiêm theo thời gian đăng ký. Tại địa điểm tiêm chủng, đơn vị quản lý sẽ điểm danh mỗi công dân bằng CMND/CCCD giống với trong danh sách hệ thống đã đăng ký. Trạng thái lịch tiêm của công dân đã điểm danh sẽ chuyển từ “đã đăng ký” thành “điểm danh”.
Những công dân đã “điểm danh” sẽ lần lượt được gọi tên vào để thực hiện tiêm chủng.
Những công dân đăng ký thành công nhưng đến buổi tiêm mà đối tượng không đến để tiêm chủng thì trạng thái lịch đăng ký của đối tượng sẽ chuyển sang "đã hủy" vào ngày hôm sau.
Nếu đối tượng được chỉ định tiêm tại các cơ sở y tế lớn để có đủ khả năng kiểm soát tình trạng sau tiêm thì trạng thái đăng ký sẽ chuyển sang “đã hủy”, lúc này đối tượng có thể đăng ký tiêm chủng mới tại một cơ sở y tế lớn theo chỉ định của bác sĩ.
* Quy trình cập nhật mũi tiêm:
Khi việc tiêm chủng được thực hiện xong theo lịch, ngay sau khi tiêm hoặc trong vòng 24 giờ, đơn vị tiêm sẽ đánh dấu thông tin tiêm chủng của đối tượng lên hệ thống, trạng thái tiêm chủng trong lịch đăng ký tiêm của đối tượng sẽ đổi từ "điểm danh" sang "đã tiêm", thông tin mũi tiêm của công dân được hệ thống ghi nhận.
Nếu sau 24 giờ mà thông tin mũi tiêm của đối tượng vẫn chưa được cập nhật thì công dân có thể tự cập nhật mũi tiêm bằng cách gửi ảnh chụp giấy chứng nhận đã tiêm lên hệ thống. Đơn vị tiêm chủng hoặc hệ thống sẽ tự động xác thực.
Những lịch đăng ký tiêm chủng có trạng thái “đã đăng ký” sau ngày tiêm chủng sẽ chuyển sang “đã hủy” (vì những công dân này không điểm danh tại buổi tiêm).
* Quy trình cập nhật chứng nhận tiêm chủng:
Các chứng nhận tiêm chủng sẽ được tự động cập nhật ngay sau khi thông tin về mũi tiêm của các đối tượng được cập nhật. 
Trong đó:
+ Đối tượng chưa tiêm mũi vaccine nào hoặc người đang dương tính thì có chứng nhận thẻ đỏ: không được hoạt động ngoài cộng đồng.
+ Đối tượng tiêm một mũi vaccine có chứng nhận thẻ vàng: bị hạn chế hoạt động ngoài địa phương.
+ Đối tượng tiêm hai mũi vaccine trở lên có chứng nhận thẻ xanh: không bị hạn chế hoạt động (CDC THÀNH PHỐ ĐÀ NẴNG 2021).

3. Phân tích yêu cầu

3.1. Yêu cầu chức năng

a) Yêu cầu lưu trữ
Hệ thống cần lưu trữ các thông tin về các loại vaccine, thông tin các đơn vị tổ chức tiêm chủng, thông tin công dân, thông tin lịch tiêm chủng, lịch đăng ký tiêm chủng, thông tin về các mũi tiêm của công dân.
* Thông tin đăng nhập: số điện thoại, mật khẩu, quyền truy cập.
* Thông tin vaccine: tên vaccine, mã vaccine, công nghệ sản xuất, nước sản xuất.
* Thông tin các đơn vị tổ chức tiêm chủng: tên đơn vị, mã đơn vị, tỉnh/thành đơn vị trực thuộc, quận/huyện đơn vị trực thuộc, xã/phường/thị trấn đơn vị trực thuộc.
* Thông tin công dân: CMND/CCCD, họ và tên đệm, tên, ngày sinh, giới tính, quê quán, tỉnh/thành thường trú/tạm trú, quận/huyện thường trú/tạm trú, xã/phường/thị trấn thường trú/tạm trú, số điện thoại, email, ghi chú, người giám hộ.
* Thông tin lịch tiêm chủng: mã lịch tiêm, mã đơn vị tiêm, mã vaccine, ngày tiêm, số lượng giới hạn người đăng ký buổi sáng, số lượng giới hạn người đăng ký buổi chiều, số lượng người đăng ký buổi sáng, số lượng người đăng ký buổi chiều.
* Thông tin lịch đăng ký tiêm chủng: CMND/CCCD của người được tiêm, số thứ tự mũi tiêm, mã vaccine.
* Thông tin các mũi tiêm của công dân: CMND/CCCD, số thứ tự mũi tiêm, mã vaccine, mã lịch tiêm.
* Thông tin chứng nhận tiêm phòng vaccine của công dân: CMND/CCCD, số liều đã tiêm, thẻ chứng nhận.
* Thông tin sức khỏe của công dân: CMND/CCCD, tình trạng sức khỏe, ngày khai báo.

b) Yêu cầu tính toán
* Tính toán độ tuổi tiêm chủng: khi công dân đăng ký tiêm chủng cho một đối tượng, hệ thống sẽ tự động truy xuất thông tin ngày sinh của đối tượng đó để thực hiện tính toán độ tuổi hiện tại. Nếu phù hợp với độ tuổi tiêm chủng theo quy định thì cho phép đăng ký tiêm chủng cho đối tượng đó.
Công thức tính độ tuổi: 
YEAR(SYSDATE) – YEAR(BIRTHDAY)
Trong đó YEAR(SYSDATE) là ngày tháng năm hiện tại, YEAR(BIRTHDAY) là ngày tháng năm sinh của đối tượng đăng ký tiêm chủng.
* Tính toán thời gian mũi tiêm tiếp theo: khi công dân đăng ký tiêm chủng cho một đối tượng, hệ thống sẽ tự động truy xuất thông tin thời gian mũi trước đây của đối tượng đó (nếu có) và truy xuất thông tin thời gian của mũi tiêm tiếp theo trong lịch đăng ký để thực hiện tính toán khoảng cách thời gian giữa hai mũi tiêm. Nếu khoảng cách thời gian giữa hai mũi tiêm phù hợp theo quy định thì cho phép đăng ký tiêm chủng cho đối tượng đó.
Công thức tính thời gian khoảng cách giữa hai mũi tiêm: 
INJECTION_DATE2 – INJECTION_DATE1
* Trong đó INJECTION_DATE2 là ngày tiêm mũi tiếp theo, NJECTION_DATE1 là ngày tiêm mũi trước đây.
* Tính toán số lượt đăng ký tiêm chủng: khi công dân đăng ký tiêm chủng cho một đối tượng nào đó tại một lịch tiêm chủng nào đó thì số lượt đăng ký tiêm chủng của lịch đó sẽ tăng lên 1 ở buổi sáng/chiều tùy theo người đăng ký. Ngược lại, khi công dân hủy đăng ký tiêm chủng cho một đối tượng nào đó tại một lịch tiêm chủng nào đó thì số lượt đăng ký tiêm chủng của lịch đó sẽ giảm đi 1 ở buổi sáng/chiều.

c) Yêu cầu tra cứu
Các chức năng tra cứu được cung cấp dựa trên quyền hạn của người dùng.
* Tra cứu thông tin về các loại vaccine, các quy định tiêm chủng được cập nhật từ Bộ Y tế: có thể được tra cứu bởi tất cả người dùng.
Kết quả kết xuất: danh sách thông tin chi tiết các loại vaccine, các quy định tiêm chủng và mũi tiêm.
* Tra cứu thông tin cá nhân: có thể được tra cứu bởi mỗi cá nhân người dùng.
Kết quả kết xuất: các thông tin cá nhân của người thực hiện tra cứu (hoặc có thể là thông tin của đối tượng dưới quyền giám hộ).
* Tra cứu thông tin các đơn vị tổ chức tiêm chủng trong khu vực: có thể được tra cứu bởi bởi tất cả người dùng 
Kết quả kết xuất: danh sách thông tin các đơn vị tổ chức tiêm chủng trong khu vực lựa chọn.
* Tra cứu thông tin lịch tiêm chủng của các đơn vị tiêm chủng: có thể được tra cứu bởi tất cả người dùng 
Kết quả kết xuất: danh sách thông tin lịch tiêm chủng của đơn vị tiêm chủng được chọn.
* Tra cứu thông tin lịch đăng ký tiêm chủng: có thể được tra cứu bởi mỗi người dùng và đơn vị tổ chức lịch tiêm đó.
Kết quả kết xuất: danh sách thông tin lịch đăng ký tiêm chủng của đối tượng tra cứu hoặc danh sách thông tin lịch đăng ký tiêm chủng của các đối tượng.
* Tra cứu thông tin các mũi tiêm vaccine đã tiêm: có thể được tra cứu bởi mỗi người dùng, Bộ Y tế và các đơn vị tổ chức tiêm các mũi tiêm đó.
Kết quả kết xuất: danh sách thông tin các mũi tiêm của đối tượng, hoặc danh sách thông tin các mũi tiêm của các đối tượng tiêm tại một đơn vị, hoặc danh sách thông tin các mũi tiêm toàn dân.
* Tra cứu chứng nhận tiêm chủng vaccine của bản thân: có thể được tra cứu bởi mỗi người dùng và Bộ Y tế.
Kết quả kết xuất: chứng nhận tiêm chủng vaccine của công dân, hoặc danh sách chứng nhận tiêm chủng vaccine của công dân.
* Tra cứu thông tin tình trạng sức của công dân: có thể được tra cứu bởi mỗi người dùng, Bộ Y tế và các đơn vị mà công dân đăng ký tiêm chủng.
Kết quả kết xuất: danh sách khai báo tình trạng sức khỏe của công dân, hoặc danh sách tình trạng sức khỏe hiện tại của các đối tượng đăng ký tiêm chủng tại một đơn vị, hoặc danh sách các đối tượng đang dương tính với Covid-19.

d) Yêu cầu thống kê và tổng hợp
* Thống kê số lượng mũi tiêm: cho phép Bộ Y tế thống kê số lượng tiêm chủng theo loại mũi tiêm (cơ bản, bổ sung, nhắc lại).
Kết xuất: Tên khu vực/vùng thống kê, số lượng người dùng đã tiêm chủng thành công theo từng yêu cầu tương ứng.
* Thống kê số người dùng đã đăng ký sử dụng hệ thống: cho phép Bộ Y tế thống kê số lượng người dùng theo độ tuổi, giới tính, khu vực.
Chức năng thống kê này được thực hiện khi Bộ Y tế muốn thống kê số lượng người dùng trên hệ thống.
Kết xuất: Số lượng người dùng đã đăng ký sử dụng hệ thống theo từng yêu cầu tương ứng.
* Thống kê số lượng người dùng nhiễm Covid-19 (dương tính): cho phép Bộ Y tế thống kê số lượng người dùng nhiễm Covid-19 trong vòng x ngày theo độ tuổi, dựa vào thông tin mà người dùng khai báo trong mục 'Khai báo y tế'.
Chức năng thống kê này được thực hiện khi Bộ Y tế muốn thống kê số lượng người dùng đã bị nhiễm Covid-19 trong vòng x ngày.
Kết xuất: Số lượng người dùng nhiễm Covid-19 theo từng độ tuổi (thông qua khai báo y tế trên hệ thống).

3.2. Yêu cầu phi chức năng
* Khả năng sử dụng: 
Giao diện của hệ thống phải đơn giản, dễ thao tác để người dùng với nhiều độ tuổi khác nhau đều có thể sử dụng một cách dễ dàng.
* Hiệu suất: 
Hệ thống phải xử lý dữ liệu trong khoảng thời gian tối đa cho phép, cập nhật thông tin của người dùng nhanh chóng nhằm hạn chế sai sót, mất mát thông tin của cơ sở dữ liệu.
Hệ thống phải gửi thông tin phản hồi, thông báo thành công hoặc thất bại ngay sau khi cập nhật thông tin trên cơ sở dữ liệu khi người dùng thực hiện các thao tác đăng ký, hủy đăng ký, khai báo y tế,...
* Tính Bảo mật: 
Hệ thống phải đảm bảo bảo mật an toàn thông tin của người dùng, không để lộ thông tin cá nhân cũng như những thông tin người dùng khai báo khi sử dụng hệ thống.
Dữ liệu chỉ được truy cập bởi những người dùng nhất định được ủy quyền.
* Độ tin cậy và tính chính xác: 
Việc thiết lập lịch tiêm chỉ có thể thực hiện bởi những người dùng được cấp quyền là các cán bộ, công/nhân viên y tế có thẩm quyền để luôn đảm bảo tính đúng đắn, chính xác khi thiết lập lịch tiêm chủng.
Công dân khi đăng ký tài khoản, đăng ký thông tin cho bản thân để sử dụng hệ thống thì thông tin đó phải đảm bảo chuẩn xác, đúng hoàn toàn với các thông tin về người được lưu trữ trên Cơ sở dữ liệu quốc gia.
Các thông tin khi công dân khai báo phải đảm bảo đúng sự thật và chịu trách nhiệm với lời khai của mình.
Các dữ liệu được lưu trữ trong hệ thống phải đảm bảo độ chính xác và cập nhật ngay khi có sự thay đổi.
* Sức chứa của hệ thống: 
Hệ thống phải có sức chứa đủ để đảm bảo người dùng khi sử dụng hệ thống không xảy ra tình trạng quá tải.
* Khả năng mở rộng và nâng cấp: 
Hệ thống phải được xây dựng để đảm bảo dễ dàng nâng cấp khi cần chỉnh sửa hoặc thêm, xóa.
 
