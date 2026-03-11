import React from "react";

function SiteTopBar() {
    return (
        <div
            style={{
                position: "fixed",
                top: 0,
                left: 0,
                right: 0,
                width: "100%",
                zIndex: 2000,
            }}
        >
            {/* Barre principale */}
            <div
                className="bg-dark text-white d-flex justify-content-between align-items-center"
                style={{
                    padding: "4px 15px",
                    minHeight: "40px",
                }}
            >
                {/* Login - visible sur tous les écrans */}
                <div className="d-flex align-items-center">
                    <a
                        href="/login"
                        className="text-white text-decoration-none small"
                    >
                        Login
                    </a>
                </div>

                {/* Réseaux sociaux - visibles sur tous les écrans */}
                <div className="d-flex align-items-center">
                    <a
                        href="#"
                        className="text-white mx-1 mx-sm-2"
                        aria-label="Facebook"
                    >
                        <i className="fab fa-facebook-f"></i>
                    </a>
                    <a
                        href="#"
                        className="text-white mx-1 mx-sm-2"
                        aria-label="Instagram"
                    >
                        <i className="fab fa-instagram"></i>
                    </a>
                    <a
                        href="#"
                        className="text-white mx-1 mx-sm-2"
                        aria-label="YouTube"
                    >
                        <i className="fab fa-youtube"></i>
                    </a>
                    <a
                        href="#"
                        className="text-white mx-1 mx-sm-2"
                        aria-label="TikTok"
                    >
                        <i className="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
        </div>
    );
}

export default SiteTopBar;
