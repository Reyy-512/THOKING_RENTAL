<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $info_web->nama_rental; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
<style>
.footer {
    background: linear-gradient(135deg, #00416A 0%, #003355 100%); /* Gradient background */
    color: white; /* White text color */
    padding: 40px 0 20px 0; /* Padding for spacing */
    margin-top: 50px; /* Space above footer */
}

.footer-content {
    text-align: center; /* Centered content */
}

.footer-logo h5 {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1.5rem;
    margin-bottom: 0;
}

.footer-info {
    margin: 20px 0;
}

.footer-info p {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    margin-bottom: 8px;
    color: #e0e0e0;
}

.footer-info i {
    color: #4CAF50; /* Green color for icons */
    width: 20px;
}

.footer-social {
    margin: 25px 0;
}

.footer-social a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    margin: 0 5px;
}

.footer-social a:hover {
    background-color: #4CAF50;
    transform: translateY(-2px);
}

.footer-divider {
    border-color: rgba(255, 255, 255, 0.2);
    margin: 25px 0;
    max-width: 200px;
    margin-left: auto;
    margin-right: auto;
}

.footer-copyright {
    margin-top: 20px;
}

.footer-text {
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    color: #b0b0b0;
}

/* Responsive design */
@media (max-width: 768px) {
    .footer {
        padding: 30px 0 15px 0;
    }
    
    .footer-logo h5 {
        font-size: 1.3rem;
    }
    
    .footer-info p {
        font-size: 13px;
    }
    
    .footer-social a {
        width: 35px;
        height: 35px;
        line-height: 35px;
        margin: 0 3px;
    }
}

@media (max-width: 576px) {
    .footer {
        padding: 25px 0 10px 0;
    }
    
    .footer-info p {
        font-size: 12px;
    }
    
    .footer-text {
        font-size: 12px;
    }
}
</style>

</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-content">
                        <div class="footer-logo mb-3">
                            <h5 class="text-white"><?= $info_web->nama_rental; ?></h5>
                        </div>
                        <div class="footer-info mb-3">
                            <p class="mb-1">
                                <i class="fas fa-phone me-2"></i> 
                                <?= isset($info_web->no_telp) ? $info_web->no_telp : '0811-4792-151 (THO-KING)'; ?>
                            </p>
                            <p class="mb-1">
                                <i class="fas fa-envelope me-2"></i>
                                <?= isset($info_web->email) ? $info_web->email : 'cvthoking001@gmail.com'; ?>
                            </p>
                            <p class="mb-1">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <?= isset($info_web->alamat) ? $info_web->alamat : 'Alamat Kami'; ?>
                            </p>
                        </div>
                        <div class="footer-social mb-3">
                            <a href="https://www.facebook.com/share/16bk2xjzwW/" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.tiktok.com/@cv.thoking?_t=ZS-8yhyOsu6Gwh&_r=1" class="text-white me-3"><i class="fab fa-tiktok"></i></a>
                            <a href="https://www.instagram.com/rental_car_thoking?igsh=M3oxenhnd255YXJ6" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        </div>
                        <hr class="footer-divider">
                        <div class="footer-copyright">
                            <span class="footer-text">
                                Copyright &copy; <?= date('Y');?> <?= $info_web->nama_rental;?>. All rights reserved.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>