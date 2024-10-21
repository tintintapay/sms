function print_div(eleId) {
    var divContents = $(`#${eleId}`).html();
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<script src="../vendor/chartjs/chart.js"><\/script>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(divContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    setTimeout(() => {
        printWindow.print();
    }, 1500);

}