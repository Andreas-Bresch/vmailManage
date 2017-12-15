'use strict';

/*
 global window
 */

window.document.addEventListener('DOMContentLoaded', init);

function confirmAction($item, $actionUrl) {
  if (confirm('Are you sure you want to delete ' + $item + '?')) {
    window.location.href = $actionUrl;
  }
}

function init() {
  Array.from(window.document.querySelectorAll('.action.delete')).forEach(button => {
    button.addEventListener('click', event => confirmItemDeletion(event));
  });
}

function confirmItemDeletion(event) {
  event.preventDefault();

  const button = event.target,
        label  = button.textContent;

  if (button.hasOwnProperty('deletionConfirmed') && button.deletionConfirmed) {
    window.location.href = button.getAttribute('href');

    return true;
  }

  button.classList.add('active');
  button.textContent       = 'Really?';
  button.deletionConfirmed = true;

  setTimeout(() => {
    button.classList.remove('active');
    button.textContent       = label;
    button.deletionConfirmed = false;
  }, 3000);
}
