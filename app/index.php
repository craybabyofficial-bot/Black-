<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000000">
    
    <meta property="og:title" content="BLACK BOX - عالم العروض الحصرية">
    <meta property="og:description" content="سجل دخولك واستمتع بأقوى العروض في عمان.">
    <meta property="og:image" content="https://i.ibb.co/Q3PV9qcr/logooo.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://m-and-y-games.duckdns.org/BLACK_BOX/app/index.php">

    <title>BLACK BOX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --gold: #d4af37; --black: #000000; }
        * { box-sizing: border-box; scrollbar-width: none; font-family: 'Segoe UI', sans-serif; }
        *::-webkit-scrollbar { display: none; }
        body { background: var(--black); color: #fff; margin: 0; padding: 0; overflow: hidden; width: 100%; height: 100%; }
        @keyframes glow { 0% { box-shadow: 0 0 5px var(--gold); } 50% { box-shadow: 0 0 15px var(--gold); } 100% { box-shadow: 0 0 5px var(--gold); } }
        #login-screen { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--black); z-index: 5000; display: flex; align-items: center; justify-content: center; }
        .bg-logo { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.3; z-index: 1; }
        .login-box { position: relative; z-index: 2; width: 85%; max-width: 350px; padding: 30px; background: rgba(5, 5, 5, 0.85); border-radius: 20px; text-align: center; border: 1px solid var(--gold); animation: glow 3s infinite; backdrop-filter: blur(5px); }
        .login-box h1 { color: var(--gold); font-size: 32px; text-shadow: 0 0 10px var(--gold); margin-bottom: 20px; }
        .login-box input { width: 100%; padding: 14px; margin: 10px 0; background: #000; border: 1px solid #333; color: #fff; border-radius: 12px; text-align: center; outline: none; }
        .btn-enter { background: var(--gold); color: #000; border: none; padding: 16px; width: 100%; border-radius: 12px; font-weight: bold; cursor: pointer; font-size: 18px; margin-top: 10px; }
        #category-screen { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--black); z-index: 4000; flex-direction: column; align-items: center; padding-top: 20px; }
        .header-main { width: 92%; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .logo-cat { height: 45px; filter: drop-shadow(0 0 5px var(--gold)); }
        .glow-name { font-size: 38px; color: var(--gold); text-shadow: 0 0 15px var(--gold); font-weight: bold; margin: 25px 0; letter-spacing: 2px; }
        .cat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; width: 92%; padding: 10px; }
        .cat-card { background: #000; border: 1px solid var(--gold); border-radius: 15px; padding: 18px 5px; text-align: center; color: var(--gold); cursor: pointer; animation: glow 4s infinite; }
        .cat-card i { display: block; font-size: 24px; margin-bottom: 8px; }
        .cat-card span { font-size: 11px; font-weight: bold; display: block; }
        #main-app { display: none; width: 100%; height: 100%; position: relative; }
        .fixed-nav { position: fixed; top: 0; width: 100%; z-index: 2000; background: rgba(0,0,0,0.95); padding: 12px 0; border-bottom: 1px solid #1a1a1a; display: flex; justify-content: center; gap: 10px; }
        .btn-nav { background: #000; color: var(--gold); border: 1px solid var(--gold); padding: 10px 15px; border-radius: 25px; font-size: 13px; font-weight: bold; cursor: pointer; }
        .btn-wide { width: 65%; text-align: center; background: linear-gradient(45deg, #000, #1a1a1a); }
        #search-popup { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.92); z-index: 7000; align-items: center; justify-content: center; backdrop-filter: blur(8px); }
        .popup-box { width: 88%; max-width: 400px; background: #080808; border: 1.5px solid var(--gold); border-radius: 25px; padding: 30px; text-align: center; box-shadow: 0 0 30px rgba(212, 175, 55, 0.3); }
        .popup-box h3 { color: var(--gold); margin-top: 0; font-size: 20px; }
        .popup-box input { width: 100%; padding: 16px; background: #000; border: 1px solid var(--gold); color: #fff; border-radius: 15px; outline: none; margin: 20px 0; text-align: center; font-size: 16px; }
        .btn-search-go { background: var(--gold); color: #000; border: none; padding: 12px 30px; border-radius: 15px; font-weight: bold; width: 100%; cursor: pointer; }
        #feed { height: 100vh; overflow-y: scroll; scroll-snap-type: y mandatory; padding-top: 75px; box-sizing: border-box; background: var(--black); }
        .v-card { position: relative; width: 96%; height: 78vh; margin: 0 auto 15px auto; border: 1px solid #222; border-radius: 25px; overflow: hidden; scroll-snap-align: center; background: #000; }
        video { width: 100%; height: 100%; object-fit: cover; }
        .area-tag { position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.7); padding: 6px 12px; border-radius: 12px; color: var(--gold); font-size: 11px; border: 0.5px solid var(--gold); z-index: 15; }
        .v-actions { position: absolute; bottom: 20px; left: 0; width: 100%; display: flex; justify-content: space-around; align-items: center; z-index: 10; }
        .act-btn { background: rgba(0,0,0,0.85); color: var(--gold); width: 52px; height: 52px; border-radius: 50%; border: 1px solid var(--gold); display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        #comment-modal { display: none; position: fixed; bottom: 0; width: 100%; height: 55%; background: #0a0a0a; z-index: 6000; border-top: 2px solid var(--gold); border-radius: 25px 25px 0 0; padding: 15px; }
    </style>
</head>
<body>
    <div id="login-screen">
        <img src="../logooo.jpeg" class="bg-logo">
        <div class="login-box"><h1>BLACK BOX</h1><input type="tel" id="u_phone" placeholder="رقم الهاتف"><input type="text" id="u_code" placeholder="كود الاستضافة (اختياري)"><button class="btn-enter" onclick="checkLogin()">دخول</button></div>
    </div>
    <div id="category-screen">
        <div class="header-main"><div style="color:var(--gold);">EN</div><img src="../logooo.jpeg" class="logo-cat"><a href="https://wa.me/962770762523" style="color:var(--gold); text-decoration:none; border:1px solid var(--gold); padding:6px 12px; border-radius:20px; font-size:12px;">إعلانك هنا</a></div>
        <div class="glow-name">BLACK BOX</div>
        <div class="cat-grid">
            <div class="cat-card" onclick="start('all')"><i class="fa-solid fa-border-all"></i><span>الكل</span></div>
            <div class="cat-card" onclick="start('food')"><i class="fa-solid fa-utensils"></i><span>مطاعم</span></div>
            <div class="cat-card" onclick="start('cafe')"><i class="fa-solid fa-coffee"></i><span>كافيهات</span></div>
            <div class="cat-card" onclick="start('clothes')"><i class="fa-solid fa-shirt"></i><span>ملابس</span></div>
            <div class="cat-card" onclick="start('taxi')"><i class="fa-solid fa-taxi"></i><span>تكسي مطار</span></div>
            <div class="cat-card" onclick="start('vip')"><i class="fa-solid fa-crown"></i><span>مميز</span></div>
        </div>
    </div>
    <div id="main-app">
        <div class="fixed-nav"><button class="btn-nav" onclick="goBack()"><i class="fa-solid fa-chevron-right"></i> رجوع</button><button class="btn-nav btn-wide" onclick="showSearch()"><i class="fa-solid fa-magnifying-glass-location"></i> قريب مني</button></div>
        <div id="feed" onscroll="handleVids()"></div>
    </div>
    <div id="search-popup"><div class="popup-box"><h3>ابحث عن منطقتك</h3><input type="text" id="areaInput" placeholder="اكتب اسم المنطقة (مثلاً: ماركا)" oninput="searchNow()"><div id="searchStatus" style="color:var(--gold); font-size:13px; margin-bottom:15px; height:20px;"></div><button class="btn-search-go" onclick="hideSearch()">عرض النتائج</button><div onclick="hideSearch()" style="margin-top:15px; font-size:12px; color:#555; cursor:pointer;">إغلاق</div></div></div>
    <div id="comment-modal">
        <div style="display:flex; justify-content:space-between; align-items:center;"><b style="color:var(--gold)">التعليقات</b><i class="fa-solid fa-times" onclick="closeCmt()"></i></div>
        <div id="cmt-list" style="height:75%; overflow-y:auto; margin:10px 0;"></div>
        <div style="display:flex; gap:8px;"><input type="text" id="cmt-in" style="flex:1; background:#000; border:1px solid var(--gold); color:#fff; padding:10px; border-radius:10px;"><button onclick="postCmt()" style="background:var(--gold); border:none; padding:10px 15px; border-radius:10px; font-weight:bold;">نشر</button></div>
    </div>
    <script>
        let currentCat = "all"; let currentVid = "";
        async function checkLogin() {
            const phone = document.getElementById('u_phone').value; const code = document.getElementById('u_code').value;
            if(!phone) { alert("الرجاء إدخال رقم الهاتف للدخول"); return; }
            const response = await fetch('login.php', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: `phone=${encodeURIComponent(phone)}&code=${encodeURIComponent(code)}` });
            const result = await response.text();
            if(result.trim() === "exists" || result.trim() === "new") { document.getElementById('login-screen').style.display = 'none'; document.getElementById('category-screen').style.display = 'flex'; }
            else if(result.trim() === "error_fake") { alert("رقم الهاتف غير صحيح."); }
            else { document.getElementById('login-screen').style.display = 'none'; document.getElementById('category-screen').style.display = 'flex'; }
        }
        function start(c) { currentCat = c; document.getElementById('category-screen').style.display = 'none'; document.getElementById('main-app').style.display = 'block'; load(c); }
        function goBack() { document.getElementById('main-app').style.display = 'none'; document.getElementById('category-screen').style.display = 'flex'; }
        function showSearch() { document.getElementById('search-popup').style.display = 'flex'; document.getElementById('areaInput').focus(); }
        function hideSearch() { document.getElementById('search-popup').style.display = 'none'; }
        async function searchNow() { const area = document.getElementById('areaInput').value; if(area.length < 2) return; load(currentCat, area); }
        async function load(c, area = '') {
            const f = document.getElementById('feed'); const status = document.getElementById('searchStatus');
            const r = await fetch(`get_ads.php?cat=${c}&area=${encodeURIComponent(area)}`); const ads = await r.json();
            if(ads.length === 0 && area !== '') { status.innerText = "عذراً لم يتم العثور على شيء قريب"; return; }
            f.innerHTML = '';
            ads.forEach(ad => {
                const videoName = ad.video.split('/').pop();
                const vId = btoa(videoName).replace(/[^a-zA-Z0-9]/g, "").substring(0, 15);
                f.innerHTML += `<div class="v-card">
                    <video loop playsinline onclick="this.paused ? this.play() : this.pause();"><source src="${ad.video}" type="video/mp4"></video>
                    ${ad.area ? `<div class="area-tag"><i class="fa-solid fa-location-dot"></i> ${ad.area}</div>` : ''}
                    <div class="v-actions">
                        <div class="act-btn" onclick="window.open('${ad.location}')"><i class="fa-solid fa-map-location-dot"></i></div>
                        <div class="act-btn" onclick="window.location.href='tel:${ad.phone}'"><i class="fa-solid fa-phone-volume"></i></div>
                        <div class="act-btn" onclick="openCmt('${vId}')"><i class="fa-solid fa-comments"></i></div>
                    </div>
                </div>`;
            });
        }
        function openCmt(id) { currentVid = id; document.getElementById('comment-modal').style.display='block'; loadCmts(); }
        function closeCmt() { document.getElementById('comment-modal').style.display='none'; }
        async function loadCmts() {
            const r = await fetch(`comments_api.php?vid=${currentVid}`); const data = await r.json();
            document.getElementById('cmt-list').innerHTML = data.map(m => `<div style="background:#111; padding:10px; border-radius:8px; margin-bottom:5px; border-right:3px solid var(--gold); font-size:14px;">${m}</div>`).join('');
        }
        async function postCmt() {
            const val = document.getElementById('cmt-in').value; if(!val) return;
            await fetch('comments_api.php', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: `vid=${currentVid}&msg=${encodeURIComponent(val)}` });
            document.getElementById('cmt-in').value = ''; loadCmts();
        }
        function handleVids() {
            const vids = document.querySelectorAll('video');
            vids.forEach(v => { const b = v.getBoundingClientRect(); if(b.top >= 0 && b.top <= window.innerHeight / 1.5) v.play(); else v.pause(); });
        }
    </script>
</body>
</html>
