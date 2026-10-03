import { Link } from "react-router-dom";
import {
    Facebook,
    Instagram,
    Twitter,
    Linkedin,
    Mail
} from "lucide-react";

import styles from "./SiteFooter.module.css";

const SiteFooter = () => {
    return (
        <footer className={styles.footer}>

            <div className={styles.container}>

                <div className={styles.grid}>

                    {/* ==========================================
              LOGO + DESCRIPTION + RÉSEAUX
          =========================================== */}
                    <div className={styles.column}>

                        <div className={styles.logoSection}>

                            <Link
                                to="/"
                                className={styles.logoLink}
                            >
                                <img
                                    src="/images/LOGO.png"
                                    alt="YOULIDA"
                                    className={styles.logoImage}
                                />
                            </Link>

                        </div>

                        <p className={styles.description}>
                            Engager les jeunes africains à être des acteurs
                            de changement pour eux-mêmes et leurs communautés.
                        </p>


                        {/* RÉSEAUX SOCIAUX */}
                        <div className={styles.socialLinks}>

                            <a
                                href="https://www.facebook.com/youlida.bfa"
                                target="_blank"
                                rel="noopener noreferrer"
                                className={styles.socialLink}
                            >
                                <Facebook className={styles.socialIcon} />
                            </a>

                            <a
                                href="https://x.com/YOULIDAbf"
                                target="_blank"
                                rel="noopener noreferrer"
                                className={styles.socialLink}
                            >
                                <Twitter className={styles.socialIcon} />
                            </a>

                            <a
                                href="https://www.linkedin.com/company/102186032/"
                                target="_blank"
                                rel="noopener noreferrer"
                                className={styles.socialLink}
                            >
                                <Linkedin className={styles.socialIcon} />
                            </a>

                        </div>

                    </div>


                    {/* ==========================================
              NAVIGATION
          =========================================== */}
                    <div className={styles.column}>

                        <h3 className={styles.title}>
                            Navigation
                        </h3>

                        <ul className={styles.list}>

                            <li>
                                <Link
                                    to="/"
                                    className={styles.link}
                                >
                                    Accueil
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/a-propos"
                                    className={styles.link}
                                >
                                    À propos
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/nos-actions"
                                    className={styles.link}
                                >
                                    Nos actions
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/call-to-action"
                                    className={styles.link}
                                >
                                    Agir avec nous
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/contact"
                                    className={styles.link}
                                >
                                    Contact
                                </Link>
                            </li>

                        </ul>

                    </div>


                    {/* ==========================================
              NOS ACTIONS
          =========================================== */}
                    <div className={styles.column}>

                        <h3 className={styles.title}>
                            Nos actions
                        </h3>

                        <ul className={styles.list}>

                            <li>
                                <Link
                                    to="/nos-actions#education"
                                    className={styles.link}
                                >
                                    Éducation
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/nos-actions#sante"
                                    className={styles.link}
                                >
                                    Santé
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/nos-actions#leadership"
                                    className={styles.link}
                                >
                                    Leadership
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/nos-actions#communaute"
                                    className={styles.link}
                                >
                                    Développement communautaire
                                </Link>
                            </li>

                        </ul>

                    </div>


                    {/* ==========================================
              CONTACT
          =========================================== */}
                    <div className={styles.column}>

                        <h3 className={styles.title}>
                            Contact
                        </h3>

                        <ul className={styles.list}>

                            <li className={styles.contactItem}>

                                <Mail className={styles.contactIcon} />

                                <a
                                    href="mailto:contact@youlida.org"
                                    className={styles.link}
                                >
                                    contact@youlida.org
                                </a>

                            </li>

                            <li>
                                <Link
                                    to="/contact"
                                    className={styles.link}
                                >
                                    Formulaire de contact
                                </Link>
                            </li>

                            <li>
                                <Link
                                    to="/call-to-action#don"
                                    className={styles.link}
                                >
                                    Faire un don
                                </Link>
                            </li>

                        </ul>


                        {/* NEWSLETTER */}
                        <div
                            style={{
                                marginTop: "15px",
                                width: "100%"
                            }}
                        >

                            <form
                                onSubmit={(e) => e.preventDefault()}
                                style={{
                                    display: "flex",
                                    width: "100%",
                                    height: "40px",
                                    borderRadius: "25px",
                                    overflow: "hidden",
                                    border: "1px solid #ccc",
                                    position: "relative"
                                }}
                            >

                                <input
                                    type="email"
                                    placeholder="S'inscrire à notre fil d'actualité"
                                    required
                                    style={{
                                        width: "100%",
                                        padding: "0 50px 0 15px",
                                        border: "none",
                                        outline: "none",
                                        fontSize: "0.9rem",
                                        lineHeight: "40px",
                                        borderRadius: "25px"
                                    }}
                                />

                                <button
                                    type="submit"
                                    style={{
                                        position: "absolute",
                                        right: "5px",
                                        top: "50%",
                                        transform: "translateY(-50%)",
                                        background: "#e63946",
                                        color: "white",
                                        border: "none",
                                        width: "30px",
                                        height: "30px",
                                        borderRadius: "50%",
                                        cursor: "pointer",
                                        fontSize: "1rem",
                                        fontWeight: "bold",
                                        display: "flex",
                                        alignItems: "center",
                                        justifyContent: "center",
                                        transition: "0.3s"
                                    }}
                                    onMouseOver={(e) => {
                                        e.currentTarget.style.background = "#c1121f";
                                    }}
                                    onMouseOut={(e) => {
                                        e.currentTarget.style.background = "#e63946";
                                    }}
                                    aria-label="S'inscrire à la newsletter"
                                >
                                    →
                                </button>

                            </form>

                        </div>

                    </div>

                </div>


                {/* ==========================================
            COPYRIGHT
        =========================================== */}
                {/* ==========================================
    COPYRIGHT
=========================================== */}
                <div className={styles.copyright}>

                    <p>
                        &copy; {new Date().getFullYear()} YOULIDA. Tous droits réservés.
                        {" "}
                        <span className={styles.separator}>|</span>
                        {" "}
                        Développé par{" "}

                        <a
                            href="https://eunital.com"
                            target="_blank"
                            rel="noopener noreferrer"
                            className={styles.eunitalLink}
                            title="Visiter le site officiel de EUNITAL"
                        >
                            EUNITAL
                        </a>
                    </p>

                </div>
            </div>

        </footer>
    );
};

export default SiteFooter;