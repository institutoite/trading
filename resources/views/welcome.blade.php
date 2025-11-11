<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Cambio Blue - Bolivia</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: rgb(38, 186, 165);
            --secondary-color: rgb(55, 95, 122);
            --accent-color: rgb(45, 156, 219);
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --gray: #6c757d;
            --dark-gray: #343a40;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            --border-radius: 16px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--dark-gray);
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
        }
        
        /* Header Styles */
        header {
            background: linear-gradient(90deg, var(--white) 0%, rgba(255,255,255,0.95) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.03);
        }
        
        .logo i {
            font-size: 2.4rem;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .logo h1 {
            font-size: 2rem;
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        
        .date-time {
            color: var(--gray);
            font-size: 0.95rem;
            background: linear-gradient(135deg, rgba(38, 186, 165, 0.1), rgba(45, 156, 219, 0.1));
            padding: 10px 18px;
            border-radius: 30px;
            border: 1px solid rgba(38, 186, 165, 0.2);
            font-weight: 600;
        }
        
        /* Main Content */
        .main-content {
            padding: 40px 0;
        }
        
        /* Exchange Card Styles */
        .exchange-card {
            background: linear-gradient(135deg, var(--white) 0%, #ffffff 100%);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 40px;
            margin-bottom: 40px;
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .exchange-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color), var(--secondary-color));
        }
        
        .exchange-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }
        
        .exchange-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--secondary-color);
            position: relative;
            display: inline-block;
            font-weight: 700;
        }
        
        .highlight {
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .exchange-rates {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin: 35px 0;
            flex-wrap: wrap;
        }
        
        .rate-box {
            background: linear-gradient(135deg, rgba(245, 247, 250, 0.8) 0%, rgba(228, 232, 240, 0.5) 100%);
            border-radius: 16px;
            padding: 25px 35px;
            min-width: 240px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(38, 186, 165, 0.1);
        }
        
        .rate-box::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
        }
        
        .rate-box:hover::after {
            transform: translateX(100%);
        }
        
        .rate-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, rgba(245, 247, 250, 1) 0%, rgba(228, 232, 240, 0.8) 100%);
        }
        
        .rate-label {
            font-size: 1rem;
            color: var(--gray);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }
        
        .rate-value {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
        }
        
        .buy {
            color: var(--success-color);
        }
        
        .sell {
            color: var(--danger-color);
        }
        
        .last-update {
            font-size: 1rem;
            color: var(--gray);
            margin-top: 18px;
            padding: 12px 20px;
            background: linear-gradient(135deg, rgba(38, 186, 165, 0.08), rgba(45, 156, 219, 0.08));
            border-radius: 12px;
            display: inline-block;
            font-weight: 600;
        }
        
        /* Chart Section */
        .chart-container {
            position: relative;
            height: 350px;
            margin-top: 25px;
            padding: 0 10px;
        }
        
        /* Calculator Styles */
        .calculator-section {
            background: linear-gradient(135deg, var(--white) 0%, #ffffff 100%);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 40px;
            margin-bottom: 40px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid rgba(38, 186, 165, 0.1);
        }
        
        .calculator-section:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }
        
        .section-title {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 35px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
            font-weight: 700;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .calc-box {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .calc-form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .calc-group {
            display: flex;
            flex-direction: column;
        }
        
        .calc-label {
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--secondary-color);
            font-size: 1.2rem;
        }
        
        .calc-input {
            padding: 18px 25px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-size: 1.2rem;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
            background-color: rgba(245, 247, 250, 0.5);
        }
        
        .calc-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(38, 186, 165, 0.15);
            background-color: var(--white);
        }
        
        .calc-btn {
            padding: 18px 30px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(38, 186, 165, 0.25);
            margin-top: 10px;
        }
        
        .calc-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(38, 186, 165, 0.35);
        }
        
        .calc-btn:active {
            transform: translateY(2px);
        }
        
        .result-box {
            background: linear-gradient(135deg, rgba(38, 186, 165, 0.08), rgba(45, 156, 219, 0.08));
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            font-size: 1.5rem;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(38, 186, 165, 0.15);
            transition: all 0.3s ease;
        }
        
        /* About Section */
        .about-section {
            background: linear-gradient(135deg, var(--white) 0%, #ffffff 100%);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 40px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
            justify-content: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid rgba(38, 186, 165, 0.1);
        }
        
        .about-section:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }
        
        .about-image {
            flex: 0 0 220px;
            text-align: center;
            position: relative;
        }
        
        .about-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(38, 186, 165, 0.2);
            border: 5px solid var(--white);
            transition: all 0.5s ease;
        }
        
        .about-image:hover img {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(38, 186, 165, 0.3);
        }
        
        .about-content {
            flex: 1;
            min-width: 280px;
        }
        
        .about-title {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            text-align: left;
            font-weight: 700;
        }
        
        .about-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .about-text {
            font-size: 1.2rem;
            color: var(--secondary-color);
            font-weight: 500;
            line-height: 1.8;
        }
        
        .about-name {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        /* Social Media Section */
        .social-section {
            background: linear-gradient(135deg, var(--white) 0%, #ffffff 100%);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 40px;
            margin-bottom: 40px;
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid rgba(38, 186, 165, 0.1);
        }
        
        .social-section:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }
        
        .social-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }
        
        .social-link {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(38, 186, 165, 0.1), rgba(45, 156, 219, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.8rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(38, 186, 165, 0.2);
        }
        
        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.4s ease;
            z-index: 0;
        }
        
        .social-link:hover::before {
            transform: scale(1);
        }
        
        .social-link:hover {
            color: white;
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(38, 186, 165, 0.4);
        }
        
        .social-link i {
            position: relative;
            z-index: 1;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--secondary-color), #1a3a52);
            color: white;
            padding: 60px 0 30px;
            position: relative;
            overflow: hidden;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color), transparent);
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin-bottom: 50px;
        }
        
        .footer-column h3 {
            font-size: 1.4rem;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 15px;
            position: relative;
            padding-left: 25px;
        }
        
        .footer-links li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-size: 1.4rem;
            line-height: 1;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            font-weight: 500;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
            transform: translateX(8px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }
        
        /* Button Styles */
        .tab-btn {
            background: linear-gradient(90deg, var(--primary-color) 60%, var(--accent-color) 100%);
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 16px 35px;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 10px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(38, 186, 165, 0.2);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }
        
        .tab-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.6s ease;
        }
        
        .tab-btn:hover::before {
            left: 100%;
        }
        
        .tab-btn.active, .tab-btn:focus, .tab-btn:hover {
            background: linear-gradient(90deg, var(--secondary-color) 60%, var(--primary-color) 100%);
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(55, 95, 122, 0.3);
            outline: none;
        }
        
        /* Animations */
        @keyframes zoomInOut {
            0% { transform: scale(1); }
            50% { transform: scale(1.25); }
            100% { transform: scale(1); }
        }
        
        .live-icon i {
            animation: zoomInOut 1.2s infinite alternate;
            color: #28a745;
            font-size: 1.8rem;
            vertical-align: middle;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .exchange-rates {
                gap: 30px;
            }
            
            .rate-box {
                min-width: 200px;
                padding: 20px 25px;
            }
            
            .rate-value {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 20px;
            }
            
            .logo h1 {
                font-size: 1.8rem;
            }
            
            .exchange-card {
                padding: 30px;
            }
            
            .calculator-section {
                padding: 30px;
            }
            
            .about-section {
                flex-direction: column;
                text-align: center;
            }
            
            .about-title {
                text-align: center;
            }
            
            .about-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .social-container {
                flex-wrap: wrap;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
        
        @media (max-width: 576px) {
            .container {
                width: 95%;
            }
            
            .section-title {
                font-size: 1.7rem;
            }
            
            .exchange-title {
                font-size: 1.5rem;
            }
            
            .tab-btn {
                padding: 14px 25px;
                font-size: 1.1rem;
                margin: 5px;
            }
            
            .social-link {
                width: 60px;
                height: 60px;
                font-size: 1.6rem;
            }
            
            .calc-input {
                font-size: 1.1rem;
                padding: 15px 20px;
            }
            
            .result-box {
                font-size: 1.3rem;
                padding: 20px;
            }
        }

        /* Hero Blue: hacer la sección principal con compra grande y venta más pequeña */
        .exchange-card.hero-blue {
            position: relative;
            overflow: hidden;
            padding-top: 48px;
            padding-bottom: 36px;
            background: linear-gradient(135deg, var(--white) 0%, #fbfffe 100%);
            border: 1px solid rgba(38,186,165,0.15);
        }
        .exchange-card.hero-blue::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(600px 260px at 85% 10%, rgba(45,156,219,0.12), transparent 60%),
                radial-gradient(700px 300px at 10% 95%, rgba(38,186,165,0.12), transparent 62%);
            pointer-events: none;
        }
        .exchange-card.hero-blue .exchange-title {
            margin-bottom: 10px;
        }
        .exchange-card.hero-blue .exchange-rates {
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: 20px;
            align-items: end;
            justify-content: center;
            margin: 20px auto 10px;
            max-width: 900px;
        }
        .exchange-card.hero-blue .rate-box {
            background: transparent;
            border: none;
            box-shadow: none;
            padding: 0;
            min-width: 0;
            text-align: center;
        }
        .exchange-card.hero-blue .rate-box .rate-label {
            color: var(--gray);
            font-weight: 800;
            letter-spacing: 1.4px;
        }
        /* Compra enorme en verde */
        .exchange-card.hero-blue .rate-box:first-child .rate-value {
            color: var(--success-color);
            font-weight: 900;
            font-size: clamp(3.2rem, 11vw, 8rem);
            line-height: 0.85;
            letter-spacing: -2px;
            text-shadow: 0 10px 32px rgba(40,167,69,0.2);
        }
        /* Venta más pequeña en rojo */
        .exchange-card.hero-blue .rate-box:last-child .rate-value {
            color: var(--danger-color);
            font-weight: 900;
            font-size: clamp(1.6rem, 4.6vw, 3rem);
            line-height: 1;
            text-shadow: 0 8px 26px rgba(220,53,69,0.15);
        }
        .exchange-card.hero-blue .last-update {
            display: inline-block;
            margin-top: 18px;
        }
        @media (max-width: 768px) {
            .exchange-card.hero-blue .exchange-rates {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            .exchange-card.hero-blue .rate-box:first-child .rate-value {
                font-size: clamp(3rem, 16vw, 6rem);
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Botón flotante de WhatsApp -->
    <a href="https://api.whatsapp.com/send/?phone=59171039910" target="_blank" rel="noopener" style="position:fixed;bottom:32px;right:32px;z-index:9999;background:linear-gradient(135deg,#25d366,#128c7e);color:white;border-radius:50%;width:64px;height:64px;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 24px rgba(38,186,165,0.25);font-size:2.3rem;transition:transform 0.2s;">
        <i class="fab fa-whatsapp"></i>
    </a>
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-exchange-alt"></i>
                <h1>Tipo de cambio en tiempo real</h1>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <!-- HERO BLUE: Sección principal al inicio (mantiene botón y última actualización) -->
            <div class="exchange-card hero-blue">
                <h2 class="exchange-title">
                    <span class="live-icon" style="display:inline-block;margin-right:15px;">
                        <i class="fas fa-broadcast-tower"></i>
                    </span>
                    Tipo de cambio de <span class="highlight">Bolivianos (Bs)</span> a <span class="highlight">Dólares (USD)</span>
                </h2>
                <div style="width:100%;text-align:center;margin-top:8px;margin-bottom:8px;">
                    <span id="liveDate" style="font-size:1.1rem;font-weight:700;color:#28a745;margin-right:12px;"></span>
                    <span id="liveHour" style="font-size:1.1rem;font-weight:700;color:#007bff;"></span>
                </div>
                <div class="exchange-rates">
                    <div class="rate-box">
                        <div class="rate-label">Compra</div>
                        <div class="rate-value buy">{{ $bs_buy ? number_format($bs_buy->rate,2) : '--' }} Bs/USD</div>
                    </div>
                    <div class="rate-box">
                        <div class="rate-label">Venta</div>
                        <div class="rate-value sell">{{ $bs_sell ? number_format($bs_sell->rate,2) : '--' }} Bs/USD</div>
                    </div>
                </div>
                <div style="margin: 16px 0;">
                    <button id="updateBlue" class="tab-btn" style="margin:0 auto;display:block;font-size:1.1rem;">
                        <i class="fas fa-sync-alt"></i> Actualizar tipo de cambio blue
                    </button>
                    <span id="updateMsg" style="margin-left:15px;color:var(--success-color);font-weight:700;display:none;"></span>
                </div>
                <div class="last-update" style="font-size:1rem;color:var(--primary-color);font-weight:700;">
                    Última actualización: {{ $last_update ? \Carbon\Carbon::parse($last_update)->locale('es')->diffForHumans() : 'No disponible' }}
                </div>
            </div>
        </div>

        <!-- Comparación Blue vs Oficial (queda debajo del hero) -->
        <div class="exchange-card" style="margin-bottom:40px;">
            <h2 class="exchange-title">Comparativa Blue vs Oficial</h2>
            <div style="display:flex;justify-content:center;gap:50px;margin:30px 0;flex-wrap:wrap;">
                <div class="rate-box">
                    <div class="rate-label">Blue Compra</div>
                    <div class="rate-value buy">{{ $bs_buy ? number_format($bs_buy->rate,2) : '--' }} Bs/USD</div>
                </div>
                <div class="rate-box">
                    <div class="rate-label">Blue Venta</div>
                    <div class="rate-value sell">{{ $bs_sell ? number_format($bs_sell->rate,2) : '--' }} Bs/USD</div>
                </div>
                <div class="rate-box">
                    <div class="rate-label">Oficial Compra</div>
                    <div class="rate-value buy" style="color:#007bff;">{{ $official_buy ? number_format($official_buy->rate,2) : '--' }} Bs/USD</div>
                </div>
                <div class="rate-box">
                    <div class="rate-label">Oficial Venta</div>
                    <div class="rate-value sell" style="color:#ff9800;">{{ $official_sell ? number_format($official_sell->rate,2) : '--' }} Bs/USD</div>
                </div>
            </div>
            <div style="text-align:center;font-size:1.1rem;color:var(--gray);font-weight:600;">
                <span style="color:var(--primary-color);font-weight:700;">Blue</span>: Mercado paralelo &nbsp;|&nbsp; <span style="color:#007bff;font-weight:700;">Oficial</span>: Banco Central de Bolivia
            </div>
        </div>

        <div class="container">
            <!-- REMOVIDO AQUÍ: la tarjeta original de tipo de cambio estaba debajo; ahora es el HERO de arriba -->
            <!-- Gráfica, calculadora, about, social, etc. -->
            <!-- Chart Section -->
            <div class="exchange-card">
                <h2 class="exchange-title">Evolución del Dólar Blue</h2>
                <div style="display:flex;justify-content:center;gap:20px;margin-bottom:25px;flex-wrap:wrap;">
                    <button class="tab-btn" id="btn-day" onclick="setActiveTab('day')"><i class="fas fa-calendar-day"></i> Hoy</button>
                    <button class="tab-btn" id="btn-week" onclick="setActiveTab('week')"><i class="fas fa-calendar-week"></i> Semana</button>
                    <button class="tab-btn active" id="btn-month" onclick="setActiveTab('month')"><i class="fas fa-calendar-alt"></i> Mes</button>
                </div>
                <div class="chart-container">
                    <canvas id="blueChart"></canvas>
                </div>
            </div>
            
            <!-- Calculator Section -->
            <div class="calculator-section">
                <h2 class="section-title">Calculadora Blue</h2>
                <div class="calc-box">
                    <form id="calcForm" class="calc-form" onsubmit="return false;">
                        <div class="calc-group" style="text-align:center;position:relative;max-width:380px;margin:0 auto;">
                            <label class="calc-label" for="amount">Cantidad:</label>
                            <div style="position:relative;display:flex;align-items:center;">
                                <input type="number" step="any" min="0" id="amount" class="calc-input" placeholder="Ingrese monto" required style="font-size:2.2rem;text-align:center;font-weight:700;width:100%;">
                                <button type="button" id="clearCalc" title="Limpiar" style="position:absolute;top:6px;right:8px;background:none;border:none;font-size:1.5rem;color:#6c757d;cursor:pointer;padding:0 8px;">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div style="display:flex;justify-content:center;gap:18px;margin:18px 0;">
                            <button type="button" id="convertBsToUsd" class="calc-btn" style="font-size:1.1rem;padding:14px 28px;background:linear-gradient(90deg, rgb(38,186,165), rgb(55,95,122));">Bs → USD Blue</button>
                            <button type="button" id="convertUsdToBs" class="calc-btn" style="font-size:1.1rem;padding:14px 28px;background:linear-gradient(90deg, rgb(55,95,122), rgb(38,186,165));">USD Blue → Bs</button>
                        </div>
                    </form>
                    <div id="result" class="result-box" style="font-size:2rem;font-weight:700;"></div>
                </div>
            </div>
            
            <!-- About Section -->
            <div class="about-section">
                <div class="about-image">
                    <img src="/images/david.png" alt="David Flores">
                </div>
                <div class="about-content">
                    <h2 class="about-title">Acerca del autor</h2>
                    <p class="about-text">
                        <span class="about-name">David Flores</span>: apasionado por educación, tecnología y tendencias. Impulsa innovación en Bolivia, combinando tecnología con desarrollo humano para transformar el futuro.
                    </p>
                </div>
            </div>
            
            <!-- Social Media Section -->
            <div class="social-section">
                <h2 class="section-title">Síguenos en nuestras redes sociales</h2>
                <p style="font-size:1.2rem;color:var(--gray);max-width:650px;margin:0 auto;font-weight:500;">Mantente informado con las últimas actualizaciones del tipo de cambio</p>
                <div class="social-container">
                    <a href="https://www.facebook.com/ite.educabol" class="social-link" target="_blank" rel="noopener">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://tiktok.com/@ite_educabol" class="social-link" target="_blank" rel="noopener">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://www.instagram.com/ite.educabol/" class="social-link" target="_blank" rel="noopener">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send/?phone=59171039910" class="social-link" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://t.me/ite_educabol" class="social-link" target="_blank" rel="noopener">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
        <!-- Sección de Preguntas Frecuentes (FAQ) -->
        <div class="exchange-card" style="margin-bottom:40px;">
            <h2 class="exchange-title">Preguntas Frecuentes (FAQ)</h2>
            <div style="text-align:left;max-width:800px;margin:0 auto;">
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Qué es el dólar paralelo?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">Es el tipo de cambio del dólar estadounidense negociado fuera del sistema bancario oficial, generalmente en casas de cambio, mercados informales o entre particulares. Suele diferir del tipo de cambio oficial fijado por el gobierno o el banco central.</p>
                </div>
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Por qué hay diferencia con el tipo de cambio oficial?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">La diferencia surge por restricciones, controles de divisas, oferta y demanda, y políticas económicas. El oficial suele estar regulado, mientras que el paralelo refleja el valor real en el mercado.</p>
                </div>
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Es legal usar el dólar paralelo?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">En Bolivia, la compra y venta de dólares fuera del sistema bancario no está prohibida, pero debe hacerse con precaución y preferentemente en lugares autorizados. El uso del paralelo es común en países con restricciones cambiarias.</p>
                </div>
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Dónde puedo consultar el tipo de cambio oficial?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">El tipo de cambio oficial se publica diariamente por el Banco Central de Bolivia y los principales bancos del país.</p>
                </div>
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Por qué varía el dólar blue?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">El dólar blue varía según la oferta y demanda, expectativas económicas, disponibilidad de divisas y factores internacionales. No está regulado por el Estado.</p>
                </div>
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Es seguro comprar dólares en el mercado paralelo?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">Si bien es común, se recomienda hacerlo en casas de cambio reconocidas y evitar transacciones informales para reducir riesgos de estafa o falsificación.</p>
                </div>
                <div style="margin-bottom:28px;">
                    <h3 style="color:var(--primary-color);font-size:1.2rem;font-weight:700;margin-bottom:8px;">¿Puedo ahorrar en dólares en Bolivia?</h3>
                    <p style="font-size:1.08rem;color:var(--gray);font-weight:500;">Sí, es posible ahorrar en dólares, tanto en bancos como en efectivo, aunque existen regulaciones para depósitos y retiros en moneda extranjera.</p>
                </div>
            </div>
        </div>
    
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-column">
                    <h3>Acerca de ITE</h3>
                    <ul class="footer-links">
                        <li><a href="https://ite.com.bo/">Página web</a></li>
                        <li><a href="https://services.ite.com.bo/">Servicios</a></li>
                        <li><a href="https://redes.ite.com.bo">Redes</a></li>
                        <li><a href="https://www.facebook.com/ite.educabol">Facebook</a></li>
                        <li><a href="https://www.tiktok.com/@ite_educabol">Tik Tok</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Servicios Educativos</h3>
                    <ul class="footer-links">
                        <li><a href="https://services.ite.com.bo/modalidades/1">Inicial</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/2">Primaria</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/3">Secundaria</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/4">Pre universitario</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/5">Institutos</a></li>
                        <li><a href="https://ite.com.bo/universitario">Universitario</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Servicios Especializados</h3>
                    <ul class="footer-links">
                        <li><a href="https://services.ite.com.bo/modalidades/8">Cubo Rubik</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/9">Ajedrez</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/11">Dactilografía</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/12">Oratoria</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/13">Lectura Escritura</a></li>
                        <li><a href="https://services.ite.com.bo/modalidades/14">Súper Memoria</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Suscripción</h3>
                    <p style="margin-bottom: 20px;font-weight:500;">Suscríbete para recibir actualizaciones diarias del tipo de cambio en tu correo.</p>
                    <form style="display: flex; margin-top: 20px;">
                        <input type="email" placeholder="Su email" style="flex: 1; padding: 15px 20px; border: none; border-radius: 8px 0 0 8px; font-family: 'Montserrat', sans-serif; font-size: 1rem;">
                        <button type="submit" style="background: linear-gradient(90deg, var(--primary-color), var(--accent-color)); color: white; border: none; padding: 0 20px; border-radius: 0 8px 8px 0; cursor: pointer; transition: all 0.3s;">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Tipo de Cambio Blue Bolivia. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Botón para limpiar la calculadora
        document.getElementById('clearCalc').addEventListener('click', function() {
            document.getElementById('amount').value = '';
            document.getElementById('result').innerHTML = '';
            document.getElementById('amount').focus();
        });
        // Fecha y hora en tiempo real para Bolivia (GMT-4)
        function updateLiveDateHour() {
            const now = new Date();
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const bolivia = new Date(utc - (4 * 60 * 60 * 1000));
            const h = bolivia.getHours().toString().padStart(2, '0');
            const m = bolivia.getMinutes().toString().padStart(2, '0');
            const s = bolivia.getSeconds().toString().padStart(2, '0');
            const d = bolivia.getDate().toString().padStart(2, '0');
            const mo = (bolivia.getMonth()+1).toString().padStart(2, '0');
            const y = bolivia.getFullYear();
            document.getElementById('liveDate').innerHTML = `<i class='fas fa-calendar-day'></i> ${d}/${mo}/${y}`;
            document.getElementById('liveHour').innerHTML = `<i class='fas fa-clock'></i> ${h}:${m}:${s}`;
        }
        setInterval(updateLiveDateHour, 1000);
        updateLiveDateHour();
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js visualización
        const chartData = {
            day: {
                labels: {!! json_encode($dayLabels ?? []) !!},
                buy: {!! json_encode($dayBuyRates ?? []) !!},
                sell: {!! json_encode($daySellRates ?? []) !!}
            },
            week: {
                labels: {!! json_encode($weekLabels ?? []) !!},
                buy: {!! json_encode($weekBuyRates ?? []) !!},
                sell: {!! json_encode($weekSellRates ?? []) !!}
            },
            month: {
                labels: {!! json_encode($monthLabels ?? []) !!},
                buy: {!! json_encode($monthBuyRates ?? []) !!},
                sell: {!! json_encode($monthSellRates ?? []) !!}
            }
        };
        
        let blueChart;
        
        function showChart(period) {
            const ctx = document.getElementById('blueChart').getContext('2d');
            if (blueChart) blueChart.destroy();
            const labels = chartData[period].labels;
            const buy = chartData[period].buy;
            const sell = chartData[period].sell;
            let chartType = 'line';
            let fill = true;
            let tension = 0.4;
            // Si solo hay un dato, mostrar scatter
            let buyType = (period === 'day' && buy.length === 1) ? 'scatter' : 'line';
            let sellType = (period === 'day' && sell.length === 1) ? 'scatter' : 'line';
            blueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Compra',
                            data: buy,
                            borderColor: 'rgb(38,186,165)',
                            backgroundColor: 'rgba(38,186,165,0.15)',
                            pointRadius: 7,
                            pointBackgroundColor: 'rgb(38,186,165)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 10,
                            fill: false,
                            tension: tension,
                            borderWidth: 4,
                            type: buyType,
                        },
                        {
                            label: 'Venta',
                            data: sell,
                            borderColor: 'rgb(219,45,45)',
                            backgroundColor: 'rgba(219,45,45,0.15)',
                            pointRadius: 7,
                            pointBackgroundColor: 'rgb(219,45,45)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 10,
                            fill: false,
                            tension: tension,
                            borderWidth: 4,
                            type: sellType,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            display: true,
                            labels: {
                                font: {
                                    size: 15,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(55, 95, 122, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            titleFont: {
                                size: 16,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 14
                            },
                            padding: 15,
                            cornerRadius: 10,
                            displayColors: true
                        }
                    },
                    scales: {
                        x: { 
                            display: true,
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 13,
                                    weight: '500'
                                }
                            }
                        },
                        y: { 
                            display: true,
                            beginAtZero: false,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: {
                                    size: 13,
                                    weight: '500'
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }
        
        function setActiveTab(period) {
            document.getElementById('btn-day').classList.remove('active');
            document.getElementById('btn-week').classList.remove('active');
            document.getElementById('btn-month').classList.remove('active');
            document.getElementById('btn-' + period).classList.add('active');
            showChart(period);
        }
        
        document.addEventListener('DOMContentLoaded', function() { 
            setActiveTab('month'); 
        });
        
        // Calculadora Bs ↔ USD Blue
        document.getElementById('convertBsToUsd').addEventListener('click', function() {
            let amount = parseFloat(document.getElementById('amount').value);
            let rate = {{ $bs_buy ? $bs_buy->rate : 0 }};
            let resultDiv = document.getElementById('result');
            if (!rate || rate <= 0) {
                resultDiv.innerHTML = '<span style="color:#dc3545;font-size:1.4rem;">No hay tasa de cambio disponible.</span>';
                return;
            }
            if (!amount || amount <= 0) {
                resultDiv.innerHTML = '<span style="color:#dc3545;font-size:1.4rem;">Ingrese una cantidad válida.</span>';
                return;
            }
            let usd = amount / rate;
            resultDiv.innerHTML =
                '<div style="text-align:center;">' +
                    '<span style="font-size:1.8rem;color:var(--primary-color);font-weight:800;">' + amount + ' Bs</span>' +
                    '<span style="font-size:1.8rem;margin:0 15px;">≈</span>' +
                    '<span style="font-size:1.8rem;color:var(--secondary-color);font-weight:800;">' + usd.toFixed(2) + ' USD (Blue)</span>' +
                    '<div style="font-size:1.1rem;color:#6c757d;margin-top:20px;font-weight:500;">al último tipo de cambio registrado</div>' +
                '</div>';
        });
        document.getElementById('convertUsdToBs').addEventListener('click', function() {
            let amount = parseFloat(document.getElementById('amount').value);
            let rate = {{ $bs_buy ? $bs_buy->rate : 0 }};
            let resultDiv = document.getElementById('result');
            if (!rate || rate <= 0) {
                resultDiv.innerHTML = '<span style="color:#dc3545;font-size:1.4rem;">No hay tasa de cambio disponible.</span>';
                return;
            }
            if (!amount || amount <= 0) {
                resultDiv.innerHTML = '<span style="color:#dc3545;font-size:1.4rem;">Ingrese una cantidad válida.</span>';
                return;
            }
            let bs = amount * rate;
            resultDiv.innerHTML =
                '<div style="text-align:center;">' +
                    '<span style="font-size:1.8rem;color:var(--secondary-color);font-weight:800;">' + amount + ' USD</span>' +
                    '<span style="font-size:1.8rem;margin:0 15px;">≈</span>' +
                    '<span style="font-size:1.8rem;color:var(--primary-color);font-weight:800;">' + bs.toFixed(2) + ' Bs (Blue)</span>' +
                    '<div style="font-size:1.1rem;color:#6c757d;margin-top:20px;font-weight:500;">al último tipo de cambio registrado</div>' +
                '</div>';
        });
        
        // Botón para actualizar tipo de cambio blue
        document.getElementById('updateBlue').addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Actualizando...';
            document.getElementById('updateMsg').style.display = 'none';
            
            const token = document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content');
            fetch('/actualizar-blue-rate', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-sync-alt"></i> Actualizar tipo de cambio blue';
                
                if (data.success) {
                    document.getElementById('updateMsg').innerText = '¡Tipo de cambio actualizado!';
                    document.getElementById('updateMsg').style.display = 'inline-block';
                    setTimeout(() => { location.reload(); }, 1200);
                } else {
                    document.getElementById('updateMsg').innerText = 'No se pudo actualizar.';
                    document.getElementById('updateMsg').style.display = 'inline-block';
                }
            })
            .catch(() => {
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-sync-alt"></i> Actualizar tipo de cambio blue';
                document.getElementById('updateMsg').innerText = 'Error al actualizar.';
                document.getElementById('updateMsg').style.display = 'inline-block';
            });
        });
    </script>
</body>
</html>