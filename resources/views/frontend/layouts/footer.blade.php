<footer class="main-footer d-flex justify-content-between align-items-center py-3 px-4 bg-white border-top flex-wrap">
    <div class="footer-left">
        © {{ date('Y') }} <strong>TechnoTech Engineering Ltd</strong> | Industrial & Construction Solutions
    </div>
    <div class="footer-right">
        Designed & Developed by 
        <a href="https://labib.work/" class="text-decoration-none" target="_blank"><strong>Md. Labib Arefin</strong> </a>
    </div>
</footer>

<style>
    .main-footer {
        font-size: 14px;
        color: #555;
    }

    .footer-left {
        text-align: left;
    }

    .footer-right {
        text-align: right;
    }

    @media (max-width: 768px) {
        .main-footer {
            flex-direction: column;
            text-align: center;
            gap: 5px;
        }
        .footer-left,
        .footer-right {
            text-align: center;
        }
    }
</style>