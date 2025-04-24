document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
      registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        
        const successAlert = document.getElementById('register-success');
        const errorAlert = document.getElementById('register-error');
        
        if (successAlert) successAlert.classList.add('d-none');
        if (errorAlert) errorAlert.classList.add('d-none');
        
        document.querySelectorAll('.invalid-feedback').forEach(el => {
          el.textContent = '';
        });
        
        const formData = {
          username: username,
          email: email,
          password: password,
          confirm_password: confirmPassword
        };
        
        fetch('/api/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(data => {
              throw new Error(data.error || 'Registration failed');
            });
          }
          return response.json();
        })
        .then(data => {
          if (successAlert) {
            successAlert.textContent = 'Registration successful! Redirecting to homepage...';
            successAlert.classList.remove('d-none');
          }
          registerForm.reset();
          
          // Redirect to homepage after successful registration
          setTimeout(() => {
            window.location.href = '/';
          }, 2000);
        })
        .catch(error => {
          if (error.response && error.response.status === 422) {
            const errors = error.response.data.errors;
            if (errors.username) document.getElementById('error-username').textContent = errors.username;
            if (errors.email) document.getElementById('error-email').textContent = errors.email;
            if (errors.password) document.getElementById('error-password').textContent = errors.password;
            if (errors.confirm_password) document.getElementById('error-confirm-password').textContent = errors.confirm_password;
          } else if (errorAlert) {
            errorAlert.textContent = error.message || 'Registration failed. Please try again.';
            errorAlert.classList.remove('d-none');
          }
        });
      });
    }
    
    // Login Form
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        
        const successAlert = document.getElementById('login-success');
        const errorAlert = document.getElementById('login-error');
        
        if (successAlert) successAlert.classList.add('d-none');
        if (errorAlert) errorAlert.classList.add('d-none');
        
        document.querySelectorAll('.invalid-feedback').forEach(el => {
          el.textContent = '';
        });
        
        fetch('/api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            username: username,
            password: password
          })
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(data => {
              throw new Error(data.error || 'Login failed');
            });
          }
          return response.json();
        })
        .then(data => {
          if (successAlert) {
            successAlert.textContent = 'Login successful! Redirecting to homepage...';
            successAlert.classList.remove('d-none');
          }
          loginForm.reset();
          
          setTimeout(() => {
            window.location.href = '/';
          }, 2000);
        })
        .catch(error => {
          if (errorAlert) {
            errorAlert.textContent = error.message || 'Login failed. Please check your credentials.';
            errorAlert.classList.remove('d-none');
          }
        });
      });
    }
    
    function checkAuthStatus() {
      fetch('/api/current-user')
        .then(response => response.json())
        .then(data => {
          const navMenu = document.querySelector('#navMenu .navbar-nav');
          
          if (data.isAuthenticated) {
            const authLinks = `
              <li class="nav-item">
                <span class="nav-link">Welcome, ${data.user.username}</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
              </li>
            `;
            
            const loginLink = navMenu.querySelector('a[href="/login"]');
            const registerLink = navMenu.querySelector('a[href="/register"]');
            
            if (loginLink) {
              const loginItem = loginLink.parentElement;
              loginItem.outerHTML = authLinks;
            } else if (registerLink) {
              const registerItem = registerLink.parentElement;
              registerItem.outerHTML = authLinks;
            }
          }
        })
        .catch(error => {
          console.error('Error checking auth status:', error);
        });
    }
    
    checkAuthStatus();
  });