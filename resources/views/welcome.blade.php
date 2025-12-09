<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Laravel</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg-a: #ff9a9e;
      --bg-b: #fad0c4;
      --card-bg: rgba(255,255,255,0.85);
      --text: #1f2937;
      --accent: #5b21b6;
    }

    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial}
    body{
      display:flex;align-items:center;justify-content:center;
      background: linear-gradient(135deg,var(--bg-a),var(--bg-b));
      transition:background 600ms ease;
      color:var(--text);
      padding:2rem;
    }

    .wrap{max-width:900px;width:100%;}

    .card{
      display:grid;grid-template-columns:1fr 320px;gap:1.5rem;
      background:var(--card-bg);
      border-radius:18px;padding:1.5rem;box-shadow:0 10px 30px rgba(2,6,23,0.15);
      backdrop-filter: blur(6px);
      align-items:center;
    }

    .left h1{margin:0;font-size:clamp(1.4rem,3vw,2.2rem);}
    .left p{margin:.6rem 0 1rem;color:#374151}

    .greeting{
      font-weight:700;color:var(--accent);
    }

    .controls{display:flex;gap:.6rem;flex-wrap:wrap}
    button{background:transparent;border:2px solid rgba(0,0,0,0.06);padding:.6rem .9rem;border-radius:10px;cursor:pointer;font-weight:600}
    .btn-primary{background:linear-gradient(90deg,#7c3aed,#06b6d4);color:white;border:0}
    .btn-ghost{background:transparent}

    .right{display:flex;flex-direction:column;gap:.7rem;align-items:center;justify-content:center}
    .preview{
      width:100%;border-radius:12px;display:flex;flex-direction:column;align-items:center;justify-content:center;font-weight:600;
      padding:1rem;
      background:linear-gradient(90deg,rgba(255,255,255,0.6),rgba(255,255,255,0.2));box-shadow:inset 0 -6px 20px rgba(0,0,0,0.04);
      text-align:center;
    }

    .small{font-size:.85rem;color:#6b7280}

    @media (max-width:820px){
      .card{grid-template-columns:1fr;}
      .right{order:-1}
    }

    .dark{
      --card-bg: rgba(12,12,15,0.65);
      --text:#e6eef8;
      --accent:#60a5fa;
    }

    footer{margin-top:1rem;text-align:center;color:rgba(0,0,0,0.45);font-size:.85rem}
    .dark footer{color:rgba(255,255,255,0.45)}

    .motto { font-size: 0.75rem; color:#6b7280; font-style: italic; margin-top:.5rem; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" id="page">
      <div class="left">
        <h1 class="greeting">Hello, ini hasil route view praktikum REKAYASA WEB!</h1>
        <p>Selamat datang, ini contoh halaman statis yang saya buat.</p>

        <div class="controls">
          <button id="rndColor" title="Ganti background gradient">🔮 Ganti Warna</button>
          <button id="toggleDark" title="Toggle dark / light">🌙 Mode Gelap</button>
          <button id="copyText" class="btn-primary" title="Salin teks greeting">📋 Salin Greeting</button>
          <button id="surprise" class="btn-ghost">✨ Surprise</button>
        </div>
      </div>

      <div class="right">
        <div class="preview" id="preview">
          <div>Nama: Ivanstwn | NIM: G.211.23.0038</div>
          <div class="motto">"Jangan hamilin anak orang sebelum sukses, takut nanti jualan pop ice"</div>
        </div>
        <div style="display:flex;gap:.5rem;align-items:center;justify-content:center;width:100%">
          <small class="small">Versi sederhana • Interaktif</small>
        </div>
      </div>
    </div>

    <footer>Dipersembahkan untuk modul RPL — coba tombol <strong>Ganti Warna</strong> dan <strong>Surprise</strong> 😎</footer>
  </div>

  <script>
    // tunggu sampai DOM ter-load supaya semua element ada
    document.addEventListener('DOMContentLoaded', () => {
      const body = document.body;
      const preview = document.getElementById('preview');
      const rndColorBtn = document.getElementById('rndColor');
      const toggleDarkBtn = document.getElementById('toggleDark');
      const copyTextBtn = document.getElementById('copyText');
      const surpriseBtn = document.getElementById('surprise');

      function randColor(){
        const h1 = Math.floor(Math.random()*360);
        const h2 = (h1 + Math.floor(Math.random()*60) + 60) % 360;
        // pakai format dengan koma biar kompatibel di banyak browser
        const a = `hsl(${h1}, 90%, 65%)`;
        const b = `hsl(${h2}, 90%, 65%)`;
        document.documentElement.style.setProperty('--bg-a', a);
        document.documentElement.style.setProperty('--bg-b', b);
        // biodata + motto
        preview.innerHTML = "<div>Nama: Ivanstwn | NIM: G.211.23.0038</div><div class='motto'>\"Jangan hamilin anak orang sebelum sukses, takut nanti jualan pop ice\"</div>";
      }

      // fallback copy untuk browser lama
      function copyToClipboard(text){
        if(navigator.clipboard && navigator.clipboard.writeText){
          return navigator.clipboard.writeText(text);
        }
        return new Promise((resolve, reject) => {
          const ta = document.createElement('textarea');
          ta.value = text;
          ta.style.position = 'fixed';
          ta.style.left = '-9999px';
          document.body.appendChild(ta);
          ta.focus();
          ta.select();
          try{
            const ok = document.execCommand('copy');
            document.body.removeChild(ta);
            if(ok) resolve();
            else reject(new Error('execCommand failed'));
          }catch(e){
            document.body.removeChild(ta);
            reject(e);
          }
        });
      }

      rndColorBtn.addEventListener('click', randColor);

      toggleDarkBtn.addEventListener('click', ()=>{
        document.documentElement.classList.toggle('dark');
        if(document.documentElement.classList.contains('dark')) {
          preview.textContent = 'Mode Gelap aktif';
        } else {
          randColor(); // balikin biodata + motto
        }
      });

      copyTextBtn.addEventListener('click', async ()=>{
        const text = 'Hello, ini modul praktikum RPL Django!';
        try{
          await copyToClipboard(text);
          preview.textContent = 'Tersalin! ✅';
          setTimeout(randColor,1200);
        }catch(e){
          alert('Gagal salin — mungkin browser lu gak dukung clipboard API atau halaman harus lewat https/localhost.');
          console.error(e);
        }
      });

      surpriseBtn.addEventListener('click', ()=>{
        for(let i=0;i<12;i++){
          const el = document.createElement('div');
          el.textContent = ['🎉','🚀','🧑‍💻','📚','✨'][Math.floor(Math.random()*5)];
          el.style.position='fixed';
          el.style.left = (10 + Math.random()*80) + '%';
          el.style.top = (10 + Math.random()*70) + '%';
          el.style.fontSize = (12 + Math.random()*30) + 'px';
          el.style.pointerEvents='none';
          el.style.opacity = '0.95';
          el.style.transition = 'transform 900ms ease, opacity 900ms ease';
          body.appendChild(el);
          setTimeout(()=>{el.style.transform='translateY(-60px) scale(1.4)';el.style.opacity='0'},900);
          setTimeout(()=>el.remove(),1800);
        }
      });

      // inisialisasi awal
      randColor();
    });
  </script>
</body>
</html>