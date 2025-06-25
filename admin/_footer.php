<style>
html, body {
    height: 100%;
}
body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.main-content-admin {
    flex: 1 0 auto;
}
footer {
    flex-shrink: 0;
    padding-top: 12px !important;
    padding-bottom: 10px !important;
    font-size: 0.98rem;
    background: rgba(34, 40, 49, 0.98) !important;
    color: #f8f9fa !important;
    border-top: 1.5px solid #2453a7;
}
</style>

<div class="main-content-admin"><!-- Konten utama admin di sini --></div>
<footer class="text-white text-center py-3 mt-4">
    <div class="container">
        <p class="mb-0">&copy; <?= date('Y') ?> Tech_Store Admin Panel. All Rights Reserved.</p>
    </div>
</footer>

<script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html> 