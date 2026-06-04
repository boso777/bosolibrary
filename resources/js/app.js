import "tailwindcss";
import AOS from 'aos';
import 'aos/dist/aos.css';
//tom select for categories settings
//gestore animazioni
AOS.init({
    duration: 800, // Durata dell'animazione in millisecondi
    once: true,    // L'animazione avviene solo la prima volta che si skrolla
});

//event listener su funzione specifica che da true solo quando livewire ha finito di scansionare tutto il dom
document.addEventListener('livewire:initialized', () => {
    const el = document.getElementById('select-categories');
    if (el) {
        const ts = new TomSelect(el, {
            plugins: ['remove_button'],
            onChange: (values) => {
                // Recupera l'istanza Livewire del componente e setta il valore
                let component = Livewire.find(el.closest('[wire\\:id]').getAttribute('wire:id'));
                component.set('selected_categories', values);
            }
        });
    }
});
