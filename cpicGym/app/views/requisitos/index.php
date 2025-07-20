<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Requisitos</title>
    <link rel="stylesheet" href="/css/requisitos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="requirements-panel">
            <!-- Header -->
            <div class="panel-header">
                <div class="header-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h1 class="panel-title">Gestión de Requisitos</h1>
                <div class="progress-indicator">
                    <span class="progress-text">100%</span>
                    <span class="progress-label">Completado</span>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <button class="tab-btn active" data-tab="tecnicos">Técnicos</button>
                <button class="tab-btn" data-tab="tecnologicos">Tecnológicos</button>
                <button class="tab-btn" data-tab="certificaciones">Certificaciones</button>
            </div>

            <!-- Search and Filter Bar -->
            <div class="search-filter-bar">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar Requisitos">
                </div>
                <button class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Filtros
                </button>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Administrativos Section -->
                <div class="requirement-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h2 class="section-title">Administrativos</h2>
                        <button class="expand-btn active" onclick="toggleSection(this)">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="section-content">
                        <div class="requirement-item">
                            <div class="checkbox-container">
                                <input type="checkbox" id="req1" checked>
                                <label for="req1" class="checkbox-label"></label>
                            </div>
                            <span class="requirement-text">Saber un lenguaje de programación</span>
                        </div>
                        <div class="requirement-item">
                            <div class="checkbox-container">
                                <input type="checkbox" id="req2" checked>
                                <label for="req2" class="checkbox-label"></label>
                            </div>
                            <span class="requirement-text">Saber 2 idiomas</span>
                        </div>
                    </div>
                </div>

                <!-- Documentación Section -->
                <div class="requirement-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h2 class="section-title">Documentación</h2>
                        <button class="expand-btn" onclick="toggleSection(this)">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="section-content collapsed">
                        <!-- Content will be shown when expanded -->
                    </div>
                </div>

                <!-- Financieros Section -->
                <div class="requirement-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h2 class="section-title">Financieros</h2>
                        <button class="expand-btn" onclick="toggleSection(this)">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="section-content collapsed">
                        <!-- Content will be shown when expanded -->
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button class="btn-primary">
                    <i class="fas fa-save"></i>
                    Guardar Cambios
                </button>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Toggle section function
        function toggleSection(btn) {
            const section = btn.closest('.requirement-section');
            const content = section.querySelector('.section-content');
            const icon = btn.querySelector('i');
            
            if (btn.classList.contains('active')) {
                btn.classList.remove('active');
                content.classList.add('collapsed');
                icon.style.transform = 'rotate(-90deg)';
            } else {
                btn.classList.add('active');
                content.classList.remove('collapsed');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Add search logic here
        });

        // Checkbox interaction
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Add checkbox change logic here
            });
        });
    </script>
</body>
</html>