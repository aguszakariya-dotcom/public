// assets/js/notifications.js

function showNotification(message, type) {
    $.notify({
      title: type.charAt(0).toUpperCase() + type.slice(1), // Capitalize the first letter
      message: message
    },{
      type: type,
      placement: {
        from: 'top',
        align: 'right'
      }
    });
  }
  