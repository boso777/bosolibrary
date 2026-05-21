// 1. PRIMA registriamo JSZip globalmente per evitare crash in epubjs
import JSZip from 'jszip';
window.JSZip = JSZip;

// 2. DOPO importiamo epubjs
import ePub from 'epubjs';

document.addEventListener('DOMContentLoaded', () => {
    const viewer = document.getElementById('viewer');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    
    if (!viewer) return;

    const epubUrl = viewer.dataset.url;
    if (!epubUrl) {
        console.error("Errore: URL del libro non trovato in data-url.");
        return;
    }

    // Inizializzazione istanza libro
    const book = ePub(epubUrl);
    
    const rendition = book.renderTo("viewer", {
        width: "100%",
        height: "100%",
        flow: "paginated", 
        method: "default",
    });

    rendition.display();

    // --- FUNZIONI DI NAVIGAZIONE COMPATTE ---
    const nextPage = () => rendition.next();
    const prevPage = () => rendition.prev();

    // --- GESTIONE CAUSA-EFFETTO ---

    // UI Click
    if (prevBtn) prevBtn.addEventListener('click', prevPage);
    if (nextBtn) nextBtn.addEventListener('click', nextPage);

    // Tastiera su Documento Principale
    document.addEventListener('keydown', handleKeydown);

    // Tastiera dentro l'IFrame del libro (Risolve il bug del focus perso)
    rendition.on('keydown', handleKeydown);

    function handleKeydown(event) {
        if (event.key === 'ArrowLeft') prevPage();
        if (event.key === 'ArrowRight') nextPage();
    }
});