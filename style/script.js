const buttons = document.querySelectorAll('.custom-button');

showCategory('allMenu');

buttons.forEach(button => {
  button.addEventListener('mouseover', function() {
    buttons.forEach(btn => {
      if (btn !== button) {
        btn.classList.add('no-hover');
      }
    });
  });

  button.addEventListener('mouseout', function() {
    buttons.forEach(btn => btn.classList.remove('no-hover'));
  });

  button.addEventListener('click', function() {
    if (button.classList.contains('active')) {
      button.classList.remove('active');
      showCategory('allMenu'); 
    } else {
      buttons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      showCategory(button.dataset.category); 
    }
  });
});

function showCategory(kategori) {
  const items = document.querySelectorAll('.item');
  items.forEach(item => {
    item.classList.remove('show'); 
    
    setTimeout(() => {
      if (kategori === 'allMenu' || item.classList.contains(kategori)) {
        item.classList.add('show'); 
      }
    }, 50); 
  });
}
