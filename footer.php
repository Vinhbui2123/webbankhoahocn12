<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .footer {
            background-color: #141414;
            padding: 50px 0;
            width: 100%;
            color: #f5f5f5;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .member-footer {
            max-width: 980px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .member-footer .link-social {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .member-footer .link-social i {
            font-size: 24px;
            color: #f5f5f5;
            transition: all 0.3s ease;
        }

        .member-footer .link-social i:hover {
            transform: scale(1.1);
            color: #e50914;
        }

        .member-footer ul {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 30px;
            padding: 0;
        }

        .member-footer ul li {
            list-style: none;
        }

        .member-footer li a {
            text-decoration: none;
            color: #808080;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .member-footer li a:hover {
            color: #f5f5f5;
        }

        .member-footer .ma-dich-vu {
            display: inline-block;
            font-size: 13px;
            padding: 8px 16px;
            border: 1px solid #808080;
            border-radius: 4px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .member-footer .ma-dich-vu:hover {
            border-color: #f5f5f5;
            color: #f5f5f5;
        }

        .member-footer .author {
            font-size: 12px;
            color: #808080;
        }

        @media (max-width: 768px) {
            .member-footer ul {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .member-footer ul {
                grid-template-columns: 1fr;
            }

            .member-footer .link-social {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="footer">
        <div class="member-footer">
            <div class="link-social">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
            <ul>
                <li><a href="">Mô tả âm thanh</a></li>
                <li><a href="">Trung tâm trợ giúp</a></li>
                <li><a href="">Thẻ Quà tặng</a></li>
                <li><a href="">Trung tâp đa phương tiên</a></li>
                <li><a href="">Quan hệ với nhà đầu tư</a></li>
                <li><a href="">Việc làm</a></li>
                <li><a href="">Điều khoản sử dụng</a></li>
                <li><a href="">Quyền riêng tư</a></li>
                <li><a href="">Thông báo pháp lý</a></li>
                <li><a href="">Tuỳ chọn cookie</a></li>
                <li><a href="">Thông tin doanh nghiệp</a></li>
                <li><a href="">Liên hệ với chúng tôi</a></li>
            </ul>
            <div class="ma-dich-vu">Mã dịch vụ</div>
            <div class="author">@2024 Nhóm 7</div>
        </div>
    </div>
</body>

</html>