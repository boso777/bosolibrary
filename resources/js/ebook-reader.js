// resources/js/ebook-reader.js
import JSZip from 'jszip';
import ePub from 'epubjs';

window.JSZip = JSZip;

document.addEventListener('DOMContentLoaded', () => {
    const viewer = document.getElementById('viewer');
    
    if (viewer) {
        const epubUrl = viewer.dataset.url;
        const book = ePub(epubUrl);
        
        const rendition = book.renderTo("viewer", {
            width: "100%",
            height: "100%",
            flow: "paginated", 
            method: "default",
            spread: "none",
        });


        rendition.display();

        // --- GESTIONE NAVIGAZIONE ---

        // Causa: Click su Freccia Sinistra (UI) -> Effetto: Pagina Precedente
        document.getElementById('prev').addEventListener('click', () => {
            rendition.prev();
        });

        // Causa: Click su Freccia Destra (UI) -> Effetto: Pagina Successiva
        document.getElementById('next').addEventListener('click', () => {
            rendition.next();
        });

        // Causa: Pressione Tasti (Tastiera) -> Effetto: Cambiamento Pagina
        document.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') {
                rendition.prev();
            }
            if (event.key === 'ArrowRight') {
                rendition.next();
            }
        });
    }
}); 