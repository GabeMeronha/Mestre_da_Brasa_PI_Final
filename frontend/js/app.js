// frontend/js/app.js
document.addEventListener('DOMContentLoaded', function () {
  // simple add to cart demo
  document.querySelectorAll('.add-to-cart').forEach(function(btn){
    btn.addEventListener('click', function(e){
      const title = this.dataset.title || 'Produto';
      alert(title + ' adicionado ao carrinho (demo).');
    });
  });

  // basic form validation demo for admin add user
  const addUserForm = document.getElementById('addUserForm');
  if(addUserForm){
    addUserForm.addEventListener('submit', function(e){
      const name = this.querySelector('input[name=name]').value.trim();
      const email = this.querySelector('input[name=email]').value.trim();
      if(!name || !email){ e.preventDefault(); alert('Por favor preencha nome e email.'); }
    });
  }
});