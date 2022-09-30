/*   == show password ==    */
const eyes = document.querySelectorAll('.content-layer__eye');
eyes.forEach(eye => {
   eye.addEventListener('click', e => {
      const input = e.target.nextElementSibling;
      const target = e.target
      if (!input.value) return;
      else if (input.type === "password") {
         input.type = "text";
         target.style.background = 'url(\"../img/icons/eye-off.svg\")';
         target.style.backgroundPosition = 'center';
         target.style.backgroundSize = 'contain';
         target.style.backgroundRepeat = 'no-repeat")';
      } else {
         input.type = "password";
         target.style.background = 'url(\"../img/icons/eye.svg\")';
         target.style.backgroundPosition = 'center';
         target.style.backgroundSize = 'contain';
         target.style.backgroundRepeat = 'no-repeat")';
      }
   })
})

/*   == form animation ==    */
document.addEventListener('DOMContentLoaded', function () {
   const slideBox = document.querySelector('.slideBox');
   const contentLayer = document.querySelector('.content-layer');
   const goRight = document.querySelector('.goRight');
   const goLeft = document.querySelector('.goLeft');

   goRight.addEventListener('click', function (e) {
      e.preventDefault();
      slideBox.style.marginLeft = '50%';
      contentLayer.style.marginLeft = '-100%';
      removeErr()
   });
   goLeft.addEventListener('click', function (e) {
      e.preventDefault();
      slideBox.style.marginLeft = '0';
      contentLayer.style.marginLeft = '0';
      removeErr()
   });
})
function removeErr() { // clear values and errors
   document.querySelectorAll('.content-layer__item').forEach(item => {
      item.classList.remove('_err');
      item.querySelector('input').value = '';
   })
}

/*   == field validate on blur and fcous ==    */
const inps = document.querySelectorAll('.inp');
inps.forEach(inp => { // add inputs event blur and focus
   inp.addEventListener('blur', formValidate);
   inp.addEventListener('focus', formRemoveError);
})
function formValidate(e) {
   let input = e.target;
   let errors = inputValidate(input);
   if (!errors.err) return;
   formAddError(input, errors.message);
}

/*   == field validators ==    */
function inputValidate(input) { // validate current input value
   switch (input.name) {
      case 'login':
         return loginTest(input);
      
      case 'password':
         return passwordTest(input);
      
      case 'confirm_password':
         return confirmPasswordTest(input);
      
      case 'email':
         return emailTest(input);
      
      case 'name':
         return nameTest(input);
   }
}

/*   == Add Remove Err ==    */
function formRemoveError(e) {
   e.target.parentElement.classList.remove('_err');
}
function formAddError(input, text) {
   let parent = input.closest('.content-layer__item')
   parent.classList.add('_err');
   parent.querySelector('.errors').innerHTML = text

}

/*   == field validators ==    */
function loginTest(input) { // validate login

   if (!input.value) return { err: true, message: 'Required field' }
   else if (input.value.length < 6) return { err: true, message: 'Minimum 6 characters.' }
   else if (input.value.length > 20) return { err: true, message: 'Maximum 20 characters.' }
   else if (/\W+/.test(input.value)) return { err: true, message: 'Use only latin letters or numbers.' } 
   else if (!/\w{6,20}/.test(input.value)) return { err: true, message: 'Use only latin letters or numbers.' } 

   return { err: false, message: '' };
}
function nameTest(input) { // validate name

   if (!input.value) return { err: true, message: 'Required field' }
   else if (input.value.length < 2) return { err: true, message: 'Minimum 2 characters.' }
   else if (input.value.length > 20) return { err: true, message: 'Maximum 20 characters.' }
   else if (/[\W\d]+/.test(input.value)) return { err: true, message: 'Use only latin letters.' } 
   else if (!/[a-zA-Z]{2,20}/.test(input.value)) return { err: true, message: 'Use only latin letters.' } 

   return { err: false, message: '' };
}
function passwordTest(input) { // validate password
   
   if (!input.value) return { err: true, message: 'Required field' }
   else if (input.value.length < 6) return { err: true, message: 'Minimum 6 characters.' }
   else if (input.value.length > 20) return { err: true, message: 'Maximum 20 characters.' }
   else if (!/\w{6,20}/.test(input.value)) return { err: true, message: 'Use only latin letters or numbers.' } 

   return { err: false, message: '' };
}
function confirmPasswordTest(input) { // validate confirm password
   let pass = input.closest('form').querySelector('input[name=password]').value;
   if (!input.value) return { err: true, message: 'Required field.' };
   else if (input.value !== pass) return { err: true, message: 'Password not confirmed' };
   return { err: false, message: '' };
}
function emailTest(input) { // validate email
   
   if (!input.value) return { err: true, message: 'Required field' }
   else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value)) return { err: true, message: 'Invalid email.' } 

   return { err: false, message: '' };
}

// submit
const forms = document.querySelectorAll('form');
forms.forEach(form => {
   form.addEventListener('submit', handleSubmitForm);
});

async function handleSubmitForm(e) {
   e.preventDefault()

   const form = e.target;
   let formData = new FormData(form);
   let errors = 0;

   form.querySelectorAll('.inp').forEach(input => {
      const inputError = inputValidate(input);
      if (!inputError.err) return;
      formAddError(input, inputError.message);
      errors++;
   })

   if (errors === 0) {
      form.classList.add('_sending');
      let response = await fetch('userRegister.php', {
         method: 'POST',
         body: formData
      });

      // console.log(response);
      response.json().then(res => console.log(res));
      
      if (response.ok) {
         // let result = await response.json();
         // alert(result.message);
         // formPreview.innerHTML = '';
         // form.reset();
         // form.classList.remove('_sending');
      }else {
         alert('Произошла ошибка с отправкой формы');
         form.classList.remove('_sending');
      }

   } else {
      alert('Заполните обязательные поля');
   }
}
/*
async function formSend(e) {
   e.preventDefault();

   let error = formValidate(form);

   let formData = new FormData(form);
   formData.append('image', formImage.files[0]);

   if (error === 0) {
      form.classList.add('_sending');
      let response = await fetch('sendmail.php', {
         method: 'POST',
         body: formData
      });
      if (response.ok) {
         let result = await response.json();
         alert(result.message);
         formPreview.innerHTML = '';
         form.reset();
         form.classList.remove('_sending');
      }else {
         alert('Ошибка');
         form.classList.remove('_sending');
      }

   } else {
      alert('Заполните обязательные поля');
   }
}
*/