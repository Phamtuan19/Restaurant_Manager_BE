# Sử dụng hình ảnh PHP chính thức của Laravel
FROM laravel:latest

# Sao chép mã nguồn Laravel vào thư mục /var/www
COPY . /var/www

# Cài đặt các phụ thuộc
RUN composer install

# Chạy các lệnh khởi tạo cần thiết (nếu có)

# Khai báo các biến môi trường
ENV APP_ENV=production
ENV APP_KEY=base64:NkoSs52ahzgFTXOgpmnzR24RbNL+OnrqQeSZHGJ5amA=

# Mở cổng 80 để truy cập ứng dụng Laravel
EXPOSE 80

# Khởi chạy ứng dụng Laravel
CMD php artisan serve --host=0.0.0.0 --port=80
