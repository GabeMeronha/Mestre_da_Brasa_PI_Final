<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mestre da Brasa - Hamburgueres Artesanais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #2d2d2d;
            color: #ffffff;
        }

        .navbar-brand img {
            height: 40px;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            border-radius: 0 0 20px 20px;
        }

        .btn-primary {
            background-color: #e63946;
            border: none;
            padding: 10px 25px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #c1121f;
        }

        .btn-secondary {
            background-color: #ffbe0b;
            border: none;
            color: #000;
            padding: 10px 25px;
            font-weight: bold;
        }

        .btn-secondary:hover {
            background-color: #e9a800;
            color: #000;
        }

        .card {
            background-color: #3a3a3a;
            border: none;
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .card-title {
            color: #ffffff;
            font-weight: bold;
        }

        .card-text {
            color: #b3b3b3;
        }

        .price {
            color: #ffbe0b;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .section-title {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #e63946;
        }

        .category-badge {
            background-color: #e63946;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 10px;
            cursor: pointer;
        }

        .category-badge.active {
            background-color: #ffbe0b;
            color: #000;
        }

        .delivery-info {
            background-color: #3a3a3a;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .footer {
            background-color: #1a1a1a;
            padding: 30px 0;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="hero-section">
        <div class="container text-center text-white">
            <h1 class="display-4 fw-bold mb-4">Hamburgueres Artesanais</h1>
            <p class="lead mb-4">Os melhores ingredientes selecionados para você</p>
            <div class="d-flex gap-3 justify-content-center">
                <button class="btn btn-danger px-4 py-2 fw-bold" onclick="verificarLogin()">Peça Agora</button>
            </div>
        </div>
    </div>

    <main class="container py-5">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <h2 class="fw-bold text-white">Nossos Hamburgueres</h2>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Hambúrguer">
                    <div class="card-body">
                        <h5 class="card-title">Basicão Top</h5>
                        <p class="card-text text-white">Pão, carne, queijo, alface e molho especial</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-danger">R$ 24,90</span>
                            <button class="btn btn-sm btn-danger" onclick="verificarLogin()">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Hambúrguer">
                    <div class="card-body">
                        <h5 class="card-title">Caramelo da Grove Street</h5>
                        <p class="card-text text-white">Pão, carne, queijo, bacon crocante e cebola caramelizada</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-danger">R$ 29,90</span>
                            <button class="btn btn-sm btn-danger" onclick="verificarLogin()">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1603064752734-4c48eff53d05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Hambúrguer">
                    <div class="card-body">
                        <h5 class="card-title">Duplo Twist Carpado</h5>
                        <p class="card-text text-white">Dois hambúrgueres, queijo, picles e molho especial</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-danger">R$ 34,90</span>
                            <button class="btn btn-sm btn-danger" onclick="verificarLogin()">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function verificarLogin() {
            // Verifica se existe uma sessão ativa (usuário logado)
            // Se não estiver logado, redireciona para a página de login
            window.location.href = '/login';
        }
    </script>
</body>