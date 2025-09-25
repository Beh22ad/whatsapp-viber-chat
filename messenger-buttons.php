<?php
/**
 * Add WhatsApp and Viber Messenger Buttons to Wordpress by WPCookie
 */
function add_messenger_buttons() {
    // Configure your phone numbers here
    $whatsapp_number = '+10000000000'; // Example: +18006927753
    $viber_number = '10000000000';    // Example:  18006927753
    
    // Device visibility settings (1 = visible, 0 = hidden)
    $whatsapp_desktop = 1; // Show WhatsApp on desktop
    $whatsapp_mobile = 1;  // Show WhatsApp on mobile
    $viber_desktop = 1;   // Show Viber on desktop
    $viber_mobile = 1;    // Show Viber on mobile
    
    // Determine if current device is mobile
    $is_mobile = wp_is_mobile();
    
    // Check if buttons should be displayed
    $show_whatsapp = ($whatsapp_desktop && !$is_mobile) || ($whatsapp_mobile && $is_mobile);
    $show_viber = ($viber_desktop && !$is_mobile) || ($viber_mobile && $is_mobile);
    
    // Don't output anything if both buttons are hidden
    if (!$show_whatsapp && !$show_viber) {
        return;
    }
    
    ?>
    <style>
        .messenger-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .messenger-button {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border-radius: 8px;
            background-color: transparent;
            position: relative;
        }
        
        .messenger-button:hover {
            transform: scale(1.1);
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .messenger-button .tooltip {
            position: absolute;
            right: 70px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .messenger-button:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }
        
        .whatsapp-button svg {
            fill: #2CB742;
            width: 55px;
            height: 55px;
        }
        
        .viber-button svg {
            fill: #7360F2;
            width: 56px;
            height: 56px;
        }
        
        @media (max-width: 768px) {
            .messenger-buttons {
                bottom: 80px;
                right: 15px;
            }
            
            .messenger-button {
                width: 55px;
                height: 55px;
            }
            
            .messenger-button .tooltip {
                right: 65px;
                font-size: 12px;
            }
            
            .whatsapp-button svg {
                width: 50px;
                height: 50px;
            }
            
            .viber-button svg {
                width: 50px;
                height: 50px;
            }
        }
    </style>
    
    <div class="messenger-buttons">
        <?php if ($show_viber): ?>
        <!-- Viber Button (Now on top) -->
        <a href="viber://chat?number=<?php echo esc_attr($viber_number); ?>" target="_blank" class="messenger-button viber-button" rel="noopener noreferrer">
            <span class="tooltip">Viber</span>
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M30 15.3785C30 6.20699 26.7692 2 16 2C5.23077 2 2 6.20699 2 15.3785C2 21.9055 3.63629 25.9182 8.46154 27.6895V30.7774C8.46154 31.9141 9.88769 32.4332 10.6264 31.5656L13.1164 28.6411C14.0113 28.7185 14.9713 28.7569 16 28.7569C26.7692 28.7569 30 24.5499 30 15.3785ZM13.7113 26.5316C14.4251 26.5882 15.1872 26.6164 16 26.6164C25.1124 26.6164 27.8462 23.0825 27.8462 15.3785C27.8462 7.67443 25.1124 4.14055 16 4.14055C6.88757 4.14055 4.15385 7.67443 4.15385 15.3785C4.15385 19.8239 5.51965 23.1859 9.53846 24.6891V29.2639C9.53846 29.6627 10.0389 29.8449 10.2981 29.5404L13.7113 26.5316Z" fill="#BFC8D0"/>
                <path d="M16 25.8548C15.1766 25.8548 14.4047 25.8262 13.6815 25.7685L10.224 29.845C9.96145 30.1546 9.45455 29.9693 9.45455 29.5638V24.9119C5.38354 23.3834 4 19.9647 4 14.4274C4 6.59346 6.76923 3 16 3C25.2308 3 28 6.59346 28 14.4274C28 22.2613 25.2308 25.8548 16 25.8548Z" fill="#9179EE"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M30 14.3785C30 5.20699 26.7692 1 16 1C5.23077 1 2 5.20699 2 14.3785C2 20.9055 3.63629 24.9182 8.46154 26.6895V29.7774C8.46154 30.9141 9.88769 31.4332 10.6264 30.5656L13.1164 27.6411C14.0113 27.7185 14.9713 27.7569 16 27.7569C26.7692 27.7569 30 23.5499 30 14.3785ZM13.7113 25.5316C14.4251 25.5882 15.1872 25.6164 16 25.6164C25.1124 25.6164 27.8462 22.0825 27.8462 14.3785C27.8462 6.67443 25.1124 3.14055 16 3.14055C6.88757 3.14055 4.15385 6.67443 4.15385 14.3785C4.15385 19.8239 5.51965 23.1859 9.53846 24.6891V29.2639C9.53846 29.6627 10.0389 29.8449 10.2981 29.5404L13.7113 25.5316Z" fill="white"/>
                <path d="M11.5432 12.1345L11.5026 12.157L11.4668 12.1866C11.1902 12.4154 10.7756 13.0434 11.1388 13.8197C11.4414 14.4665 12.1157 15.7874 13.3005 16.7826C14.4592 17.756 15.6965 18.2795 16.5092 18.4509L16.5603 18.4617H16.6069C16.6091 18.4619 16.614 18.4624 16.6219 18.4636C16.6412 18.4663 16.6645 18.4703 16.7012 18.4767L16.7874 17.9842L16.7012 18.4767C16.7075 18.4778 16.714 18.479 16.7208 18.4802C16.9709 18.5244 17.5704 18.6304 18.0729 18.1297C18.3954 17.8083 18.6898 17.4732 18.8165 17.3225C18.9055 17.2413 19.1956 17.0731 19.5626 17.1972C20.2576 17.4321 21.0839 17.9621 21.4833 18.2308C21.7925 18.439 22.4924 18.9404 22.8079 19.1682L22.8082 19.1684C22.8344 19.1873 22.8959 19.2493 22.9291 19.3354C22.9557 19.4042 22.97 19.4988 22.9061 19.6357C22.7875 19.8895 22.4266 20.374 21.9378 20.7978C21.4401 21.2294 20.9222 21.5 20.5072 21.5C20.5087 21.5 20.5072 21.4998 20.5025 21.4992C20.484 21.4967 20.4153 21.4874 20.2792 21.4568C20.1262 21.4225 19.9195 21.3686 19.6669 21.2926C19.1622 21.1407 18.485 20.904 17.7029 20.5675C16.1375 19.8941 14.1668 18.8277 12.3218 17.2572C11.1613 16.2694 10.0664 14.9036 9.2138 13.6251C8.35407 12.3358 7.77896 11.1932 7.62244 10.6655L7.61148 10.6285L7.595 10.5937C7.55603 10.5114 7.50112 10.3355 7.50002 10.136C7.49895 9.94333 7.54725 9.75923 7.67465 9.60657C8.09467 9.10322 8.53938 8.60859 9.52049 8.13395C9.61188 8.08974 9.75504 8.05076 9.89575 8.04849C10.04 8.04617 10.1152 8.082 10.1452 8.10835C10.5206 8.43751 11.1025 9.01857 11.4945 9.51513C11.6971 9.77164 11.9418 10.0975 12.1458 10.3806C12.2478 10.5222 12.3377 10.6506 12.4062 10.7527C12.4405 10.8039 12.4679 10.8462 12.4881 10.8788C12.5019 10.9012 12.5093 10.9143 12.5124 10.9199C12.5141 10.9256 12.5218 10.9498 12.5286 10.9939C12.5371 11.0494 12.5411 11.1177 12.5354 11.1891C12.5235 11.3351 12.4755 11.4524 12.3892 11.5315C12.0962 11.7998 11.699 12.0482 11.5432 12.1345ZM16.2766 6.51613C16.2769 6.51585 16.2772 6.51557 16.2775 6.51527C16.2847 6.50852 16.2994 6.5 16.3226 6.5C20.3145 6.5 23.4984 9.53785 23.5 13.223C23.4994 13.2239 23.4983 13.2251 23.4967 13.2267C23.4895 13.2334 23.4747 13.2419 23.4516 13.2419C23.4285 13.2419 23.4137 13.2334 23.4065 13.2267C23.4049 13.2251 23.4039 13.2239 23.4032 13.223C23.4016 9.49946 20.2032 6.53226 16.3226 6.53226C16.2994 6.53226 16.2847 6.52374 16.2775 6.51699C16.2772 6.51669 16.2769 6.5164 16.2766 6.51613ZM16.2775 10.646C16.2772 10.6457 16.2769 10.6454 16.2766 10.6452C16.2769 10.6449 16.2772 10.6446 16.2775 10.6443C16.2847 10.6376 16.2994 10.629 16.3226 10.629C17.8916 10.629 19.1113 11.8182 19.1129 13.223C19.1123 13.2239 19.1112 13.2251 19.1096 13.2267C19.1024 13.2334 19.0877 13.2419 19.0645 13.2419C19.0414 13.2419 19.0266 13.2334 19.0194 13.2267C19.0178 13.2251 19.0168 13.2239 19.0161 13.223C19.0145 11.7799 17.7803 10.6613 16.3226 10.6613C16.2994 10.6613 16.2847 10.6528 16.2775 10.646ZM16.2775 8.5815C16.2772 8.58121 16.2769 8.58092 16.2766 8.58065C16.2769 8.58037 16.2772 8.58008 16.2775 8.57979C16.2847 8.57304 16.2994 8.56452 16.3226 8.56452C19.1031 8.56452 21.3048 10.678 21.3065 13.223C21.3058 13.2239 21.3048 13.2251 21.3032 13.2267C21.296 13.2334 21.2812 13.2419 21.2581 13.2419C21.2349 13.2419 21.2201 13.2334 21.213 13.2267C21.2114 13.2251 21.2103 13.2239 21.2097 13.223C21.2081 10.6397 18.9917 8.59677 16.3226 8.59677C16.2994 8.59677 16.2847 8.58825 16.2775 8.5815Z" fill="white" stroke="white" stroke-linecap="round"/>
            </svg>
        </a>
        <?php endif; ?>
        
        <?php if ($show_whatsapp): ?>
        <!-- WhatsApp Button (Now at bottom) -->
        <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>" target="_blank" class="messenger-button whatsapp-button" rel="noopener noreferrer">
            <span class="tooltip">WhatsApp</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="800" fill="none" viewBox="0 0 32 32"><path fill="#BFC8D0" fill-rule="evenodd" d="M16 31c7.732 0 14-6.268 14-14S23.732 3 16 3 2 9.268 2 17c0 2.51.661 4.867 1.818 6.905L2 31l7.315-1.696A13.938 13.938 0 0 0 16 31Zm0-2.154c6.543 0 11.846-5.303 11.846-11.846 0-6.542-5.303-11.846-11.846-11.846C9.458 5.154 4.154 10.458 4.154 17c0 2.526.79 4.867 2.138 6.79L5.23 27.77l4.049-1.013a11.791 11.791 0 0 0 6.72 2.09Z" clip-rule="evenodd"/><path fill="url(#a)" d="M28 16c0 6.627-5.373 12-12 12-2.528 0-4.873-.782-6.807-2.116L5.09 26.909l1.075-4.03A11.945 11.945 0 0 1 4 16C4 9.373 9.373 4 16 4s12 5.373 12 12Z"/><path fill="#fff" fill-rule="evenodd" d="M16 30c7.732 0 14-6.268 14-14S23.732 2 16 2 2 8.268 2 16c0 2.51.661 4.867 1.818 6.905L2 30l7.315-1.696A13.938 13.938 0 0 0 16 30Zm0-2.154c6.543 0 11.846-5.303 11.846-11.846 0-6.542-5.303-11.846-11.846-11.846C9.458 4.154 4.154 9.458 4.154 16c0 2.526.79 4.867 2.138 6.79L5.23 26.77l4.049-1.013a11.791 11.791 0 0 0 6.72 2.09Z" clip-rule="evenodd"/><path fill="#fff" d="M12.5 9.5c-.333-.669-.844-.61-1.36-.61-.921 0-2.359 1.105-2.359 3.16 0 1.684.742 3.528 3.243 6.286 2.414 2.662 5.585 4.039 8.218 3.992 2.633-.047 3.175-2.313 3.175-3.078 0-.339-.21-.508-.356-.554-.897-.43-2.552-1.233-2.928-1.384-.377-.15-.573.054-.695.165-.342.325-1.019 1.284-1.25 1.5-.232.215-.578.106-.721.024-.53-.212-1.964-.85-3.107-1.958-1.415-1.371-1.498-1.843-1.764-2.263-.213-.336-.057-.542.021-.632.305-.351.726-.894.914-1.164.189-.27.04-.679-.05-.934-.387-1.097-.715-2.015-.981-2.55Z"/><defs><linearGradient id="a" x1="26.5" x2="4" y1="7" y2="28" gradientUnits="userSpaceOnUse"><stop stop-color="#5BD066"/><stop offset="1" stop-color="#27B43E"/></linearGradient></defs></svg>
        </a>
        <?php endif; ?>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Optional: Add click tracking if needed
        const messengerButtons = document.querySelectorAll('.messenger-button');
        messengerButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // You can add analytics tracking here if needed
                console.log('Messenger button clicked:', this.classList.contains('whatsapp-button') ? 'WhatsApp' : 'Viber');
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'add_messenger_buttons');