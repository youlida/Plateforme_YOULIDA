// components/AnimatedText.jsx
import { useState, useEffect } from 'react';
import styles from './AnimatedText.module.css';

export default function AnimatedText({ text, speed = 100, className = '' }) {
  const [displayedText, setDisplayedText] = useState('');
  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    if (currentIndex < text.length) {
      const timeout = setTimeout(() => {
        setDisplayedText(prev => prev + text[currentIndex]);
        setCurrentIndex(prev => prev + 1);
      }, speed);

      return () => clearTimeout(timeout);
    }
  }, [currentIndex, text, speed]);

  return (
    <span className={`${styles.animatedText} ${className}`}>
      {displayedText}
      <span className={styles.cursor}>|</span>
    </span>
  );
}