{*
* Product 3D Viewer - Home Page Display
*
* @author    Claude AI
* @copyright 2025
* @license   AFL - Academic Free License (AFL 3.0)
*}

<div class="product3d-viewer-section">
    <div class="container">
        <div class="product3d-header">
            <h2 class="product3d-title">{$title|escape:'htmlall':'UTF-8'}</h2>
            {if $subtitle}
                <p class="product3d-subtitle">{$subtitle|escape:'htmlall':'UTF-8'}</p>
            {/if}
        </div>

        <div class="product3d-gallery">
            {* Example Product 1 - Chair *}
            <div class="product3d-item">
                <div class="product3d-viewer-wrapper">
                    <model-viewer
                        src="{$module_dir}models/chair.glb"
                        alt="3D Chair Model"
                        {if $auto_rotate}auto-rotate{/if}
                        {if $camera_controls}camera-controls{/if}
                        shadow-intensity="1"
                        loading="lazy"
                        poster="{$module_dir}models/chair-poster.jpg"
                        class="product3d-model">
                        <div class="progress-bar hide" slot="progress-bar">
                            <div class="update-bar"></div>
                        </div>
                    </model-viewer>
                </div>
                <div class="product3d-info">
                    <h3>Modern Chair</h3>
                    <p>Explore this beautiful modern chair in 3D</p>
                </div>
            </div>

            {* Example Product 2 - Lamp *}
            <div class="product3d-item">
                <div class="product3d-viewer-wrapper">
                    <model-viewer
                        src="{$module_dir}models/lamp.glb"
                        alt="3D Lamp Model"
                        {if $auto_rotate}auto-rotate{/if}
                        {if $camera_controls}camera-controls{/if}
                        shadow-intensity="1"
                        loading="lazy"
                        poster="{$module_dir}models/lamp-poster.jpg"
                        class="product3d-model">
                        <div class="progress-bar hide" slot="progress-bar">
                            <div class="update-bar"></div>
                        </div>
                    </model-viewer>
                </div>
                <div class="product3d-info">
                    <h3>Designer Lamp</h3>
                    <p>View this elegant lamp from every angle</p>
                </div>
            </div>

            {* Example Product 3 - Sofa *}
            <div class="product3d-item">
                <div class="product3d-viewer-wrapper">
                    <model-viewer
                        src="{$module_dir}models/sofa.glb"
                        alt="3D Sofa Model"
                        {if $auto_rotate}auto-rotate{/if}
                        {if $camera_controls}camera-controls{/if}
                        shadow-intensity="1"
                        loading="lazy"
                        poster="{$module_dir}models/sofa-poster.jpg"
                        class="product3d-model">
                        <div class="progress-bar hide" slot="progress-bar">
                            <div class="update-bar"></div>
                        </div>
                    </model-viewer>
                </div>
                <div class="product3d-info">
                    <h3>Comfort Sofa</h3>
                    <p>Interact with this comfortable sofa in 3D</p>
                </div>
            </div>
        </div>

        <div class="product3d-controls-info">
            <p><i class="material-icons">touch_app</i> Click and drag to rotate • Scroll to zoom • Right-click to pan</p>
        </div>
    </div>
</div>
