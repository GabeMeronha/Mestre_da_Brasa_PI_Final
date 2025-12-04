<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mestre da Brasa - Hamburgueres Artesanais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* O estilo base já virá do base.php se fosse usado render(), mas como home.php é chamado direto em algumas lógicas, vamos garantir */
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            border-bottom: 4px solid #ff9800;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }
        
        .hero-title {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            font-size: 3.5rem;
        }

        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(255, 152, 0, 0.15);
            border-color: #ff9800;
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .price {
            color: #ff9800;
            font-size: 1.4rem;
            font-weight: bold;
        }
        
        .btn-danger {
            background-color: #d32f2f;
            border: none;
        }
        
        .btn-hero {
            background-color: #ff9800;
            color: #000;
            font-weight: bold;
            padding: 12px 30px;
            font-size: 1.2rem;
            border: none;
            transition: 0.3s;
        }
        
        .btn-hero:hover {
            background-color: #e68900;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="hero-section">
        <div class="container text-center text-white">
            <h1 class="hero-title fw-bold mb-3">Mestre da Brasa</h1>
            <p class="lead mb-4 fs-4">O verdadeiro sabor artesanal feito com paixão.</p>
            <div class="d-flex gap-3 justify-content-center">
                <button class="btn btn-hero rounded-pill shadow" onclick="verificarLogin()">PEÇA AGORA</button>
            </div>
        </div>
    </div>

    <main class="container py-5">
        <div class="d-flex justify-content-center align-items-center mb-5">
            <h2 class="fw-bold text-white border-bottom border-warning pb-2 px-4">Nossos Destaques</h2>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Hambúrguer">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-warning">Basicão Top</h5>
                        <p class="card-text text-secondary flex-grow-1">Pão brioche selado na manteiga, 180g de blend da casa, queijo cheddar derretido, alface americana e molho especial.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">R$ 24,90</span>
                            <button class="btn btn-outline-warning btn-sm" onclick="verificarLogin()">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100">
                    <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Hambúrguer">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-warning">Caramelo da Grove</h5>
                        <p class="card-text text-secondary flex-grow-1">Pão australiano, 200g de carne suculenta, queijo prato, bacon crocante em tiras e muita cebola caramelizada.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">R$ 29,90</span>
                            <button class="btn btn-outline-warning btn-sm" onclick="verificarLogin()">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100">
                    <img src="https://images.unsplash.com/photo-1603064752734-4c48eff53d05?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Hambúrguer">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-warning">Duplo Twist</h5>
                        <p class="card-text text-secondary flex-grow-1">Para quem tem fome de verdade: dois hambúrgueres de 150g, dobro de queijo, picles artesanal e maionese defumada.</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">R$ 34,90</span>
                            <button class="btn btn-outline-warning btn-sm" onclick="verificarLogin()">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function verificarLogin() {
            window.location.href = '/login';
        }
    </script>
</body>
</html>