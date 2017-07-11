/**
 * Created by andy on 11.07.17.
 */


function confirmAction($item, $actionUrl) {
    if (confirm('Are you sure you want to delete ' + $item + '?')) {
        window.location.href = $actionUrl;
    }
}