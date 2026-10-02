import { Link } from "react-router-dom";
import { Button } from "./ui/button";
import { Menu, X } from "lucide-react";
import styles from "./SiteHeader.module.css";
import { useState } from "react";

const SiteHeader = () => {
    const [isMenuOpen, setIsMenuOpen] = useState(false);

    const closeMenu = () => {
        setIsMenuOpen(false);
    };

    return (
        <header className={styles.header}>
            <div className={styles.container}>

                {/* =========================
            LOGO
        ========================== */}
                <Link
    to="/"
    className={styles.logo}
    onClick={closeMenu}
>
    <img
        src="/images/LOGO.png"
        alt="YOULIDA"
        className={styles.logoImage}
    />
</Link>


                {/* =========================
            NAVIGATION DESKTOP
        ========================== */}
                <nav className={styles.nav}>

                    <Link
                        to="/"
                        className={styles.navLink}
                    >
                        Accueil
                    </Link>

                    <Link
                        to="/a-propos"
                        className={styles.navLink}
                    >
                        À propos
                    </Link>

                    <Link
                        to="/nos-actions"
                        className={styles.navLink}
                    >
                        Nos actions
                    </Link>

                    <Link
                        to="/call-to-action"
                        className={styles.navLink}
                    >
                        Agir avec nous
                    </Link>

                    <Link
                        to="/contact"
                        className={styles.navLink}
                    >
                        Contact
                    </Link>

                </nav>


                {/* =========================
            ACTIONS
        ========================== */}
                <div className={styles.actions}>

                    <Button asChild className={styles.donateButton}>
                        <Link to="/call-to-action#don">
                            Faire un don
                        </Link>
                    </Button>


                    {/* Bouton menu mobile */}
                    <Button
                        variant="ghost"
                        size="icon"
                        className={styles.menuButton}
                        onClick={() => setIsMenuOpen(!isMenuOpen)}
                        aria-label={
                            isMenuOpen
                                ? "Fermer le menu"
                                : "Ouvrir le menu"
                        }
                    >
                        {isMenuOpen ? (
                            <X className={styles.menuIcon} />
                        ) : (
                            <Menu className={styles.menuIcon} />
                        )}
                    </Button>

                </div>


                {/* =========================
            NAVIGATION MOBILE
        ========================== */}
                {isMenuOpen && (

                    <nav
                        className={`${styles.nav} ${styles.mobileNav}`}
                    >

                        <Link
                            to="/"
                            className={styles.navLink}
                            onClick={closeMenu}
                        >
                            Accueil
                        </Link>

                        <Link
                            to="/a-propos"
                            className={styles.navLink}
                            onClick={closeMenu}
                        >
                            À propos
                        </Link>

                        <Link
                            to="/nos-actions"
                            className={styles.navLink}
                            onClick={closeMenu}
                        >
                            Nos actions
                        </Link>

                        <Link
                            to="/call-to-action"
                            className={styles.navLink}
                            onClick={closeMenu}
                        >
                            Agir avec nous
                        </Link>

                        <Link
                            to="/contact"
                            className={styles.navLink}
                            onClick={closeMenu}
                        >
                            Contact
                        </Link>

                    </nav>

                )}

            </div>
        </header>
    );
};

export default SiteHeader;