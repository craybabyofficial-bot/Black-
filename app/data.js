async function renderVideos() {
    const feed = document.getElementById('video-feed');
    feed.innerHTML = '<p style="text-align:center; color:#d4af37; padding:20px;">جاري جلب العروض الفخمة...</p>';
    
    try {
        const response = await fetch('get_ads.php');
        const adsData = await response.json();
        feed.innerHTML = ''; 

        if(adsData.length === 0) {
            feed.innerHTML = '<p style="text-align:center; color:#fff;">لا توجد فيديوهات مرفوعة حالياً</p>';
            return;
        }

        adsData.forEach(ad => {
            feed.innerHTML += `
                <div class="video-wrapper">
                    <video loop muted playsinline onclick="this.paused?this.play():this.pause()">
                        <source src="../${ad.video}" type="video/mp4">
                    </video>
                    <div class="side-info">
                        <div class="action-btn" onclick="openInfo('${ad.shopName}', '${ad.phone}', '${ad.location}')">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="action-btn" onclick="window.location.href='tel:${ad.phone}'">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <span class="views-count">${ad.views}</span>
                    </div>
                </div>`;
        });
    } catch (e) {
        feed.innerHTML = '<p style="text-align:center; color:red;">خطأ في الاتصال بالسيرفر</p>';
    }
}

// استدعاء الدالة عند فتح التطبيق
document.addEventListener('DOMContentLoaded', () => {
    // إذا كنت تريد العرض فوراً بدون تسجيل دخول للتجربة:
    // renderVideos(); 
});
