<?= $this->extend('layout/template'); ?>

<?= $this->section('css') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    /* ----- Variabel & Gaya Dasar ----- */
    :root {
        --primary-color: #00b8f1; /* Diubah agar sesuai dengan gradien baru */
        --secondary-color: #006b94; /* Diubah agar sesuai dengan gradien baru */
        --bg-color: #f4f7fc;
        --card-bg-color: #ffffff;
        --text-color: #4f5d75;
        --heading-color: #2d3748;
        --border-color: #e2e8f0;
        --shadow-color: rgba(0, 0, 0, 0.08);
        --font-family: 'Poppins', sans-serif;
    }

    body {
        /* font-family: var(--font-family); */
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .detail-container {
        padding: 2rem;
        max-width: 1400px;
        margin: auto;
    }

    /* ----- Layout Grid Utama ----- */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 1024px) {
        .content-grid {
            grid-template-columns: 2fr 1fr;
        }
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* ----- Header Section (DIPERBARUI) ----- */
    .header-card {
        background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1611926653458-09294b3142bf?auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        border-radius: 0.5rem; /* Mirip .rounded-3 */
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Mirip .shadow-sm */
        margin-bottom: 2rem;
        color: white;
    }

    .header-content {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1.5rem; /* Mirip .p-4 */
    }
    
    .header-content h1 {
        margin: 0;
        font-weight: 700; /* Mirip .fw-bold */
        font-size: 2.25rem;
    }


    /* ----- Gaya Kartu Umum ----- */
    .styled-card {
        background-color: var(--card-bg-color);
        border-radius: 12px;
        box-shadow: 0 4px 15px var(--shadow-color);
        padding: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .styled-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--heading-color);
    }
    
    .card-header i {
        font-size: 1.2rem;
        color: var(--primary-color);
    }

    .card-header h3, .card-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 1.2rem;
    }

    /* ----- Konten Utama ----- */
    .cover-section .cover-image {
        width: 100%;
        height: auto;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .caption-card .caption-text {
        line-height: 1.8;
        font-style: italic;
    }

    /* ----- Galeri ----- */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
    }

    .gallery-item {
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover {
        transform: scale(1.05);
    }
    
    .gallery-item img, .gallery-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* ----- Sidebar ----- */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        position: sticky;
        top: 2rem;
    }
    
    .upload-date {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--heading-color);
        text-align: center;
    }

    /* ----- Platform Media Sosial ----- */
    .platform-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .platform-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .platform-icon {
        flex-shrink: 0;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        color: white;
        font-size: 1.4rem;
    }
    
    /* Warna Khas Platform */
    .platform-icon.instagram { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
    .platform-icon.facebook { background: #1877F2; }
    .platform-icon.twitter { background: #1DA1F2; }
    .platform-icon.tiktok { background: #000000; }
    .platform-icon.youtube { background: #FF0000; }
    .platform-icon.linkedin { background: #0A66C2; }
    
    .platform-info h5 {
        margin: 0 0 2px 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--heading-color);
    }

    .platform-info span {
        font-size: 0.9rem;
        color: var(--text-color);
    }
    
    /* ----- Tombol Kembali ----- */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        padding: 0.8rem 1.5rem;
        background: var(--card-bg-color);
        color: var(--secondary-color);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 1rem;
        align-self: flex-start;
    }

    .back-button:hover {
        background: var(--secondary-color);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 107, 148, 0.4);
    }

    /* ----- Lightbox (Popup Media) ----- */
    .media-lightbox {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.4s ease;
        backdrop-filter: blur(8px);
    }

    .media-lightbox.show {
        opacity: 1;
    }

    .media-lightbox-content {
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        transform: scale(0.8);
        transition: transform 0.4s ease;
    }

    .media-lightbox.show .media-lightbox-content {
        transform: scale(1);
    }

    .lightbox-close {
        position: absolute;
        top: 2rem; right: 2rem;
        background: rgba(255,255,255,0.1);
        color: white;
        border: none;
        width: 45px; height: 45px;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        display: grid;
        place-items: center;
        transition: all 0.3s ease;
    }

    .lightbox-close:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(90deg);
    }

</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="detail-container">
    <div class="header-card">
        <div class="header-content">
            <div>
                 <h1><?= $konten['judul'] ?></h1>
            </div>
            </div>
    </div>

    <div class="content-grid">
        <div class="main-content">
            <div class="cover-section">
                <img src="<?= base_url('assets/sosmed/cover/' . $konten['cover']) ?>"
                     alt="Cover Image" class="cover-image">
            </div>

            <div class="caption-card styled-card">
                <div class="card-header">
                    <i class="fas fa-quote-left"></i>
                    <h3>Caption</h3>
                </div>
                <div class="caption-text">
                    <?= nl2br($konten['caption']) /* nl2br untuk menjaga format baris baru */ ?>
                </div>
            </div>

            <div class="gallery-card styled-card">
                <div class="card-header">
                    <i class="fas fa-images"></i>
                    <h4>Konten yang Diupload</h4>
                </div>
                <div class="gallery-grid">
                    <?php foreach ($konten['detail_konten'] as $detail): ?>
                        <?php if ($detail['tipe_media'] === 'foto'): ?>
                            <div class="gallery-item" data-media-type="image" data-media-src="<?= base_url('assets/sosmed/konten/' . $detail['media']) ?>">
                                <img src="<?= base_url('assets/sosmed/konten/' . $detail['media']) ?>" alt="Foto Konten">
                            </div>
                        <?php elseif ($detail['tipe_media'] === 'video'): ?>
                            <div class="gallery-item" data-media-type="video" data-media-src="<?= base_url('assets/sosmed/konten/' . $detail['media']) ?>">
                                <video>
                                    <source src="<?= base_url('assets/sosmed/konten/' . $detail['media']) ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <a href="<?= route_to('konten') ?>" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Konten
            </a>
        </div>

        <div class="sidebar">
            <div class="info-card styled-card">
                <div class="card-header">
                    <i class="fas fa-calendar-alt"></i>
                    <h4>Tanggal Upload</h4>
                </div>
                <div class="upload-date"><?= date('d F Y', strtotime($konten['tgl_upload'])) ?></div>
            </div>

            <div class="info-card styled-card">
                <div class="card-header">
                    <i class="fas fa-share-alt"></i>
                    <h4>Platform Media Sosial</h4>
                </div>
                <div class="platform-list">
                    <?php foreach ($konten['sosmed'] as $sosmed) : ?>
                        <div class="platform-item">
                            <div class="platform-icon <?= strtolower($sosmed['platform']) ?>">
                                <i class="fab fa-<?= strtolower($sosmed['platform']) ?>"></i>
                            </div>
                            <div class="platform-info">
                                <h5><?= ucfirst($sosmed['platform']) ?></h5>
                                <span>@<?= $sosmed['username'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <?php if(isset($konten['bisnis'])): ?>
            <div class="info-card styled-card">
                <div class="card-header">
                    <i class="fas fa-briefcase"></i>
                    <h4>Jenis Bisnis</h4>
                </div>
                <div class="platform-item">
                    <div class="platform-icon" style="background: #6a11cb;">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="platform-info">
                        <h5><?= $konten['bisnis']['nama_bisnis'] ?></h5>
                        <span><?= $konten['bisnis']['deskripsi'] ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');

    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const mediaType = this.dataset.mediaType;
            const mediaSrc = this.dataset.mediaSrc;

            if (!mediaType || !mediaSrc) return;

            // --- Create Lightbox Elements ---
            const lightbox = document.createElement('div');
            lightbox.className = 'media-lightbox';

            let lightboxMedia;
            if (mediaType === 'image') {
                lightboxMedia = document.createElement('img');
                lightboxMedia.src = mediaSrc;
            } else {
                lightboxMedia = document.createElement('video');
                lightboxMedia.src = mediaSrc;
                lightboxMedia.controls = true;
                lightboxMedia.autoplay = true;
            }
            lightboxMedia.className = 'media-lightbox-content';
            
            const closeBtn = document.createElement('button');
            closeBtn.className = 'lightbox-close';
            closeBtn.innerHTML = '<i class="fas fa-times"></i>';

            // --- Append Elements ---
            lightbox.appendChild(lightboxMedia);
            lightbox.appendChild(closeBtn);
            document.body.appendChild(lightbox);
            
            // --- Show with Animation ---
            requestAnimationFrame(() => {
                lightbox.classList.add('show');
            });

            // --- Close Functionality ---
            const closeLightbox = () => {
                lightbox.classList.remove('show');
                lightbox.addEventListener('transitionend', () => {
                    if (lightbox.parentNode) {
                        document.body.removeChild(lightbox);
                    }
                    document.removeEventListener('keydown', handleEscape);
                }, { once: true });
            };

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });
            
            closeBtn.addEventListener('click', closeLightbox);

            const handleEscape = (e) => {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            };
            document.addEventListener('keydown', handleEscape);
            
            lightboxMedia.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        });
    });
});
</script>
<?= $this->endSection(); ?>