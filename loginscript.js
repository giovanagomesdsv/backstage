// JavaScript para passar o tipo de usuário selecionado para a próxima tela de login
  document.getElementById('proximoBtn').addEventListener('click', function() {
        var tipoUsuario = document.getElementById('tipo_usuario').value;
        if (tipoUsuario) {
            document.getElementById('tipoSelecionado').value = tipoUsuario;
            document.getElementById('selectType').style.display = 'none';
            document.getElementById('loginContainer').style.display = 'block';

            // Ajustar os links com base no tipo de usuário
            if (tipoUsuario == '1') {
                document.getElementById('cadastro-link').style.display = 'inline-block';
                document.getElementById('resenhista-link').style.display = 'none';
            } else if (tipoUsuario == '0') {
                document.getElementById('resenhista-link').style.display = 'inline-block';
                document.getElementById('cadastro-link').style.display = 'none';
            } else {
                document.getElementById('resenhista-link').style.display = 'none';
                document.getElementById('cadastro-link').style.display = 'none';
            }
        } else {
            alert('Por favor, selecione um tipo de usuário.');
        }
    });
