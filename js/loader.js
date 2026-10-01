document.addEventListener("DOMContentLoaded", function() {
  const win = document.querySelector("#winner");
  const loader = document.querySelector(".loder-con");
  const canvas = document.getElementById('circularLoader');
  const ctx = canvas.getContext('2d');
 
  const cw = ctx.canvas.width;
  const ch = ctx.canvas.height;
  const start = 4.72;
 
  var myModal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
  });
 
  var al = 0;
  var diff;
  var sim;
  var fetchedWinner = null;
 
  function progressSim() {
    diff = ((al / 100) * Math.PI * 2 * 10).toFixed(2);
    ctx.clearRect(0, 0, cw, ch);
    ctx.lineWidth = 17;
    ctx.fillStyle = '#4285f4';
    ctx.strokeStyle = "#4285f4";
    ctx.textAlign = "center";
    ctx.font = "28px monospace";
    ctx.fillText(al + '%', cw * .52, ch * .5 + 5, cw + 12);
    ctx.beginPath();
    ctx.arc(100, 100, 75, start, diff / 10 + start, false);
    ctx.stroke();
 
    if (al >= 100) {
      clearInterval(sim);
      loader.style.display = "none";
      al = 0;
 
      const winnerBody = document.getElementById('winnerBody');
      if (fetchedWinner && fetchedWinner.success) {
        winnerBody.innerHTML =
          '<h1>' + escapeHtml(fetchedWinner.firstName) + ' ' + escapeHtml(fetchedWinner.lastName) + '</h1>' +
          '<p class="text-muted">' + escapeHtml(fetchedWinner.email) + '</p>' +
          '<button type="button" id="claimPrize" class="btn btn-warning mt-3">استلام الجائزة</button>' +
          '<p id="claimMessage" class="mt-3 fw-bold fs-5" style="display:none;"></p>';

        launchConfetti(); 

        document.getElementById('claimPrize').addEventListener('click', function() {
          const msg = document.getElementById('claimMessage');
          msg.textContent = 'إن شاء الله بالجنة 😄';
          msg.style.display = 'block';
          this.disabled = true;
          launchConfetti();
        });

      } else {
        winnerBody.innerHTML = '<p>لا يوجد مشاركين حتى الآن</p>';
      }
 
      myModal.show();
      return;
    }
    al++;
  }
 
 
  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }
 
  win.addEventListener("click", function() {
    loader.style.display = "block";
    al = 0;
    fetchedWinner = null;
 
    fetch('inc/get_winner.php')
      .then(response => response.json())
      .then(data => {
        fetchedWinner = data;
      })
      .catch(err => {
        console.error('خطأ في جلب الفائز:', err);
        fetchedWinner = { success: false };
      });
 
    sim = setInterval(progressSim, 30);
  });
 
  
  function launchConfetti() {
    if (typeof confetti !== 'function') {
      console.warn('مكتبة canvas-confetti غير محمّلة — تأكد من إضافة سطر الـ script في head');
      return;
    }
 
    confetti({
      particleCount: 150,
      spread: 90,
      startVelocity: 45,
      origin: { x: 0.5, y: 0.6 }
    });
 
    const duration = 3000;
    const end = Date.now() + duration;
 
    (function frame() {
      confetti({
        particleCount: 4,
        angle: 60,
        spread: 55,
        origin: { x: 0, y: 0.6 },
        shapes: ['square'],
        scalar: 1.4
      });
      confetti({
        particleCount: 4,
        angle: 120,
        spread: 55,
        origin: { x: 1, y: 0.6 },
        shapes: ['square'],
        scalar: 1.4
      });
 
      if (Date.now() < end) {
        requestAnimationFrame(frame);
      }
    })();
  }
 
 
  document.getElementById('modal').addEventListener('hidden.bs.modal', function() {
    document.body.classList.remove('modal-open');
    document.body.style.removeProperty('overflow');
    document.body.style.removeProperty('padding-right');
    document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
      backdrop.remove();
    });
  });
});