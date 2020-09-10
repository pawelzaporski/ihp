<canvas id="qr-code"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
    /* JS comes here */
    var qr;
    (function() {
            qr = new QRious({
            element: document.getElementById('qr-code'),
            size: 200,
            value: '<?php echo $czesc[0]->qr; ?>'
        });
    })();

    window.print();
</script>