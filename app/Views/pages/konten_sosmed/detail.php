<?= $this->extend('layout/template'); ?>

<?= $this->section('css') ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    /* === HEADER SECTION === */
    .header-card {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2);
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .back-button {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 50px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .back-button:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .header-content {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .header-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .business-name {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    /* === MAIN LAYOUT === */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        align-items: start;
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* === COVER IMAGE === */
    .cover-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .cover-image {
        width: 100%;
        height: 350px;
        border-radius: 12px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .cover-image:hover {
        transform: scale(1.02);
    }

    /* === CAPTION SECTION === */
    .caption-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .caption-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .caption-header i {
        color: #3b82f6;
        font-size: 1.25rem;
    }

    .caption-header h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
    }

    .caption-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #475569;
    }

    /* === GALLERY SECTION === */
    .gallery-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .gallery-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .gallery-header i {
        color: #3b82f6;
        font-size: 1.25rem;
    }

    .gallery-header h4 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
    }

    .gallery-item {
        position: relative;
        aspect-ratio: 9/16;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .gallery-item:hover {
        transform: translateY(-4px);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        backdrop-filter: blur(5px);
    }

    /* === SIDEBAR === */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        position: sticky;
        top: 2rem;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .card-header i {
        color: #3b82f6;
        font-size: 1.125rem;
    }

    .card-header h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
    }

    /* === DATE CARD === */
    .upload-date {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .upload-time {
        color: #64748b;
        font-size: 0.9rem;
        text-align: center;
    }

    /* === PLATFORM CARDS === */
    .platform-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .platform-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .platform-item:hover {
        background: #f1f5f9;
        transform: translateX(4px);
    }

    .platform-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .instagram {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    }

    .tiktok {
        background: #000000;
    }

    .facebook {
        background: #1877f2;
    }

    .twitter {
        background: #1da1f2;
    }

    .platform-info h5 {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }

    .platform-info span {
        color: #64748b;
        font-size: 0.9rem;
    }

    /* === STATS SECTION === */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    .stat-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: #3b82f6;
        display: block;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* === RESPONSIVE DESIGN === */
    @media (max-width: 768px) {
        .container {
            margin: 1rem auto;
            padding: 0 0.75rem;
        }

        .header-card {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .header-content h1 {
            font-size: 2rem;
        }

        .back-button {
            position: static;
            margin-bottom: 1rem;
            align-self: flex-start;
        }

        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .stat-item {
            padding: 0.75rem;
        }

        .stat-number {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .header-content h1 {
            font-size: 1.75rem;
        }

        .business-name {
            font-size: 1.1rem;
        }

        .gallery-grid {
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- Header Section -->
    <div class="header-card">
        <div class="header-content">
            <h1><?= $konten['judul'] ?></h1>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Cover Image -->
            <div class="cover-section">
                <img src="<?= base_url('assets/sosmed/cover/' . $konten['cover']) ?>"
                    alt="Cover Image" class="cover-image">
            </div>

            <!-- Caption Section -->
            <div class="caption-card">
                <div class="caption-header">
                    <i class="fas fa-quote-left"></i>
                    <h3>Caption</h3>
                </div>
                <div class="caption-text">
                    <?= $konten['caption'] ?>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="gallery-card">
                <div class="gallery-header">
                    <i class="fas fa-images"></i>
                    <h4>Konten yang Diupload</h4>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-grid">
                        <?php foreach ($konten['detail_konten'] as $detail): ?>
                            <?php if ($detail['tipe_media'] === 'foto'): ?>
                                <div class="gallery-item">
                                    <img src="<?= base_url('assets/sosmed/konten/' . $detail['media']) ?>" alt="Foto Konten">
                                </div>
                            <?php elseif ($detail['tipe_media'] === 'video'): ?>
                                <div class="gallery-item">
                                    <video controls style="max-width: 100%; border-radius: 12px;">
                                        <source src="<?= base_url('assets/sosmed/konten/' . $detail['media']) ?>" type="video/mp4">
                                        Browser tidak mendukung video.
                                    </video>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Date Card -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-calendar-alt"></i>
                    <h4>Tanggal Upload</h4>
                </div>
                <div class="upload-date"><?= $konten['tgl_upload'] ?></div>
            </div>

            <!-- Platform Card -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-share-alt"></i>
                    <h4>Platform Media Sosial</h4>
                </div>
                <div class="platform-list">
                    <?php foreach ($konten['sosmed'] as $sosmed) : ?>
                        <div class="platform-item">
                            <div class="platform-icon <?= $sosmed['platform']?>">
                                <i class="fab fa-<?= $sosmed['platform']?>"></i>
                            </div>
                            <div class="platform-info">
                                <h5><?= $sosmed['platform']?></h5>
                                <span>@<?= $sosmed['username']?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lightbox functionality untuk gallery
        const galleryItems = document.querySelectorAll('.gallery-item');

        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                if (!img) return;

                // Create lightbox
                const lightbox = document.createElement('div');
                lightbox.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.95);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                    cursor: pointer;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                `;

                // Create image
                const lightboxImg = document.createElement('img');
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt;
                lightboxImg.style.cssText = `
                    max-width: 90%;
                    max-height: 90%;
                    object-fit: contain;
                    border-radius: 12px;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
                    transform: scale(0.8);
                    transition: transform 0.3s ease;
                `;

                // Create close button
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '<i class="fas fa-times"></i>';
                closeBtn.style.cssText = `
                    position: absolute;
                    top: 2rem;
                    right: 2rem;
                    background: rgba(255,255,255,0.2);
                    color: white;
                    border: none;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    font-size: 1.5rem;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                    transition: all 0.3s ease;
                `;

                // Add elements to lightbox
                lightbox.appendChild(lightboxImg);
                lightbox.appendChild(closeBtn);
                document.body.appendChild(lightbox);

                // Animate in
                requestAnimationFrame(() => {
                    lightbox.style.opacity = '1';
                    lightboxImg.style.transform = 'scale(1)';
                });

                // Close functionality
                const closeLightbox = () => {
                    lightbox.style.opacity = '0';
                    lightboxImg.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        if (lightbox.parentNode) {
                            document.body.removeChild(lightbox);
                        }
                    }, 300);
                };

                lightbox.addEventListener('click', closeLightbox);
                closeBtn.addEventListener('click', closeLightbox);

                // Close on escape key
                const handleEscape = (e) => {
                    if (e.key === 'Escape') {
                        closeLightbox();
                        document.removeEventListener('keydown', handleEscape);
                    }
                };
                document.addEventListener('keydown', handleEscape);

                // Prevent image click from closing lightbox
                lightboxImg.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            });
        });

        // Enhanced hover effects for cards
        const cards = document.querySelectorAll('.info-card, .gallery-item, .platform-item, .stat-item');

        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
        });

        // Smooth scroll for back button
        const backButton = document.querySelector('.back-button');
        if (backButton) {
            backButton.addEventListener('click', function(e) {
                // Add smooth transition effect if needed
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        }
    });
</script>
<?= $this->endSection(); ?>