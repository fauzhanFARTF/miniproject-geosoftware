from flask import Flask, render_template, request
import folium
import geopandas as gpd
import os
from folium.plugins import MousePosition, MeasureControl, Draw, MiniMap, MarkerCluster

app = Flask(__name__)

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
ASSETS_DIR = os.path.join(BASE_DIR, 'assets')

def load_filtered_toko(kecamatan=None, keyword=None):
    gdf = gpd.read_file(os.path.join(ASSETS_DIR, 'Toko_Modern_Centroids.json'))
    if kecamatan:
        gdf = gdf[gdf['Kecamatan'].str.contains(kecamatan, case=False, na=False)]
    if keyword:
        gdf = gdf[gdf['N_Alfamart'].str.contains(keyword, case=False, na=False)]
    return gdf

@app.route("/", methods=["GET", "POST"])
def indeks():
    kecamatan = request.form.get('kecamatan', '').strip()
    keyword = request.form.get('keyword', '').strip()

    toko_filtered = load_filtered_toko(kecamatan, keyword)

    # Peta dasar
    m = folium.Map(location=[-6.1950, 106.5528], zoom_start=11, control_scale=True, height=650, width="100%")

    # Batas Desa (Choropleth)
    try:
        desa_gdf = gpd.read_file(os.path.join(ASSETS_DIR, 'Desa.shp'))
        desa_gdf.to_file(os.path.join(ASSETS_DIR, 'Desa_temp.json'), driver='GeoJSON')
        folium.Choropleth(
            geo_data=os.path.join(ASSETS_DIR, 'Desa_temp.json'),
            name='Kepadatan Penduduk Desa',
            data=gpd.read_file(os.path.join(ASSETS_DIR, 'Desa.dbf')),
            columns=['DESA_KEL', 'KEP_PEND'],
            key_on='properties.DESA_KEL',
            fill_color='Spectral_r',
            fill_opacity=0.75,
            line_opacity=0.3,
            legend_name="Kepadatan Penduduk per Desa/Kelurahan (2015)"
        ).add_to(m)
    except Exception as e:
        print("⚠️ Gagal muat layer Desa:", e)

    # Marker Cluster
    if not toko_filtered.empty:
        marker_cluster = MarkerCluster().add_to(m)
        for _, row in toko_filtered.iterrows():
            folium.Marker(
                location=[row.geometry.y, row.geometry.x],
                popup=row['N_Alfamart'],
                tooltip=row['Kecamatan'] or "Tidak diketahui"
            ).add_to(marker_cluster)

    # Basemaps
    basemaps = {
        'Google Maps': folium.TileLayer(tiles='https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', attr='Google', name='Google Maps'),
        'OpenStreetMap': folium.TileLayer(tiles='OpenStreetMap', attr='OSM', name='OpenStreetMap')
    }
    for tile in basemaps.values():
        tile.add_to(m)

    folium.LayerControl().add_to(m)
    Draw(export=False, position="topleft").add_to(m)
    MousePosition(position='bottomright').add_to(m)
    MeasureControl(position='topright').add_to(m)
    MiniMap().add_to(m)

    return render_template(
        'index.php',
        map_html=m._repr_html_(),
        kecamatan=kecamatan,
        keyword=keyword,
        total_toko=len(toko_filtered)
    )

if __name__ == "__main__":
    app.run(debug=True)