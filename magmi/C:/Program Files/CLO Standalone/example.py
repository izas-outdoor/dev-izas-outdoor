from MVPython import  MarvelousDesignerAPI
from MVPython.MarvelousDesignerAPI import *
import MarvelousDesigner
from MarvelousDesigner import *

#If you want to load your python file, please type "sys.path.append(input path where file is located here)" in console.
#ex) sys.path.append("C:/Users/Young/Downloads/") or sys.path.append("C:\\\\Users\\\\Young\\\\Downloads\\\\")
class example():
    mdsa = None
    avatar_listWidget = None
    garment_listWidget = None
    animation_listWidget = None
    save_listWidget = None
    avatar_ext_comboBox = None
    garment_ext_comboBox = None
    animation_ext_comboBox = None
    save_ext_comboBox = None
    widget = None
    save_folder_path = ""

    #this function is an exmaple of single process
    #single process defines a series of actions, which is 'set an option' .'set a path to be loaded'.'set a simulation option'.'set a save path'.'call a processing function'.
    #You can designate the path for each file you want to load.
    #Also You can designate a save path for each file
    #object is mdsa (MarvelousDesigner Script API)
    def ExtractFabricImage(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize() 
        #Set Loaded Fabric Folder Path
        #object.set_fabric_folder("D:\\Test File(Company)\\SoruceFabric", "zfab") 
        #object.setSaveImageFolderPath("D:\\Test File(Company)\\TargetFabric\\TargetImage")
        object.set_fabric_folder("D:\\Test File(Company)\\SourceFabric", "zfab")
        object.setSaveImageFolderPath("D:\\Test File(Company)\\TargetFabric\\TargetImage")

        object.Extract()

    def ChangeFabricImage(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize() 
        object.set_fabric_folder("D:\\Test File(Company)\\SourceFabric", "zfab")
        object.setSaveImageFolderPath("D:\\Test File(Company)\\TargetFabric\\TargetImage")
        object.set_save_folder_path("D:\\Test File(Company)\\TargetFabric", "zfab")

        object.ChangeFabricImage()

    def run_single_process_example(self, object): 
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize() 
        #set exporting option
        object.set_open_option("mm", 30) 
        #set importing option
        object.set_save_option("mm", 30, False)
        #set Alembic Format True = Ogawa, False = hdf5. Default is hdf5. (This function is only valid when exporting alembic file.)
        object.set_alembic_format_type(True)
        #Set the path of an Avatar file you want to load.
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")
        #Set simulation option.
        object.set_simulation_options(0, 0, 5000) 
        #Set the saving file path.
        object.set_save_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\test_01.abc")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(True)
        #If you finish setting file paths and options. You must call process function.
        object.process() 

    #this function is anohter exmaple for single process 
    #call 'single_process' function with the each file path, options and paths to save file
    #also designate the folder where the files will be stored.
    def run_single_process_second_example(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize() 
        #set exporting option
        object.set_open_option("cm", 30)
        #set importing option
        object.set_save_option("mm", 30, False) 
        #designate the folder where the files will be stored and file extension setting
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999", "mc") 
        #call the "single_process" function
        object.single_process(
            "C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\default.zpac",
            "C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt",
            "C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Pose\\Female_A\\F_A_pose_02_attention.pos") 

    #this function is example for multi process 
    def run_multi_example(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.455\\Garment", "zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.455\\Avatar\\Avatar\\Female\\Feifei.avt")
        #set folder path of multiple animation folder and extension (file extension must be supported by Marvelous Designer)
        object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.455\\Avatar\\Avatar\\Female\\Motion", "mtn")
        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.455\\Output", "fbx")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()

    #this function is example for multi process 
    def fbx(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")

        object.set_export_unified_uv_texcoordnate(True, 1000, 5)

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\ambient_test.zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")
        #set folder path of multiple animation folder and extension (file extension must be supported by Marvelous Designer)
        object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Pose\\Female_A", "pos")
        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "abc")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()

    #this function is example for multi process 
    def run_example_simulation(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")
        
        #Set simulation property settings
        #Set Simulation property options(simulation quality) of integer type
        # qulity = 0 Complete
        # qulity = 1 Normal
        # qulity = 2 Custom
        object.set_simulation_quality(2)
        #Set Simulation property options(simulation time step) of floating point type
        object.set_simulation_time_step(0.030000)
        #Set Simulation property options(number of simulation) of integer type
        object.set_simulation_number_of_simulation(2)
        #Set Simulation property options(simulation cg finish condition type) of integer type
        # cg finish condition type = 0 ITERATION
        # cg finish condition type = 1 RESIDUAL
        object.set_simulation_cg_finish_condition(0)
        #Set Simulation property options(simulation cg iteration count) of integer type
        object.set_simulation_cg_iteration_count(40)
        #Set Simulation property options(simulation cg residual) of floating point type
        #object.on_simulation_cg_residual(0.00020)
        #Set Simulation property options(self collision iteration count) of integer type
        object.set_simulation_self_collision_iteration_count(2)
        #Set Simulation property options(air damping) of floating point type
        object.set_simulation_air_damping(2.0)
        #Set Simulation property options(gravity) of floating point type
        object.set_simulation_gravity(-9000.00)
        #Set Simulation property options(number of CPU in use) of integer type
        object.set_simulation_number_of_cpu_in_use(3)
        #Set Simulation property options(nonlinear simulation) of boolean type
        object.set_simulation_nonlinear_simulation(True)
        #Set Simulation property options(ground collision) of boolean type
        object.set_simulation_ground_collision(False)
        #Set Simulation property options(ground height) of floating point type
        object.set_simulation_ground_height(2.0)
        #Set Simulation property options(avatar-cloth collision detection triangle-vertex) of boolean type
        object.set_simulation_avatar_cloth_collision_detection_triangle_vertex(False)
        #Set Simulation property options(self collision detection triangle-vertex) of boolean type
        object.set_simulation_self_collision_detection_trianlge_vertex(False)
        #Set Simulation property options(self collision detection edge-edge) of boolean type
        object.set_simulation_self_collision_detection_edge_edge(False)
        #Set Simulation property options(self collision detection avoidance stiffness) of floating point type
        object.set_simulation_self_collision_detection_avoidance_stiffness(0.001111)
        #Set Simulation property options(proximity detection vertex-triangle) of boolean type
        object.set_simulation_proximity_detection_vertex_triangle(False)
        #Set Simulation property options(proximity detection edge-edge) of boolean type
        object.set_simulation_proximity_detection_edge_edge(False)
        #Set Simulation property options(intersection resolution) of boolean type
        object.set_simulation_intersection_resolution(False)
        #Set Simulation property options(layer based collision detection) of boolean type
        object.set_simulation_layer_based_collision_detection(False)

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\Women_Set.zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")
        #set folder path of multiple animation folder and extension (file extension must be supported by Marvelous Designer)
        object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Pose\\Female_A", "pos")
        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "obj")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()

    #this function is example for multi process 
    def run_example_windcontroller(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")

        #Set wind controller settings
        #Set wind controller property options(activate) of boolean type
        object.set_windcontroller_wind_activate(True)
        #Set wind controller property options(wind type) of integer type
        object.set_windcontroller_wind_type(1)
        #Set wind controller property options(wind strength) of integer type
        object.set_windcontroller_wind_strength(5500)
        #Set wind controller property options(wind decay) of integer type
        object.set_windcontroller_wind_decay(0)
        #Set wind controller property options(wind frequency) of floating point type
        object.set_windcontroller_wind_frequency(0.0)
        #Set wind controller property options(wind turbulence) of integer type
        object.set_windcontroller_wind_turbulence(30)
        #Set wind controller property options(translate) of floating point type
        object.set_windcontroller_translate_x(-262.47)
        object.set_windcontroller_translate_y(1000.00)
        object.set_windcontroller_translate_z(612.41)

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\Women_Set.zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")

        #set folder path of multiple animation folder and extension (file extension must be supported by Marvelous Designer)
        object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Pose\\Female_A", "pos")

        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "obj")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()

    #this function is example for multi process 
    def run_multi_example_with_obj_exoprt_option(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")

        #Set exporting options (only export option)
        object.on_export_garment_with_relative_objects_only()

        #Set exporting options (multi object option)
        object.on_export_multi_object()
        #Set exporting options (weld option)
        object.on_export_weld()
        #Set exporting options (thick option)
        object.on_export_thick()

        #Set exporting options (unified UV coordinates option)
        # first value : Unified Textures of boolean type
        # second value : Texture Size(Width & Height) of integer type
        # third value : Fill Texture Seams of integer type
        # fourth value : Texture Margin Property
        #               True(absolute length(mm)) , False(relative uv coordinate (0-1))
        # fifth value : Texture Margin Value
        object.set_export_unified_uv_texcoordnate(True, 1000, 5, True, 0.01)

        #Set exporting options (include inner shape option)
        #object.on_export_include_inner_shape()
        #Set exporting options (save with texture files(ZIP) option)
        #object.on_export_save_with_texture()
        #Set exporting options (save with meta data(XML) option)
        #object.on_export_save_meta_data()
        #Set exporting options (Diffuse Color Combined on Texture option)
        object.on_export_diffuse_color_combined()
        #Set exporting options (Exclude Ambient Color option)
        object.on_export_exclude_ambient_color()

        #Set exporting options (Axis Conversion option) of string type
        object.set_export_axis_x("Y")
        object.set_export_axis_y("Z")
        object.set_export_axis_z("X")

        #Set exporting options (Axis Invert option)
        object.on_export_invert_x()
        object.on_export_invert_y()
        object.on_export_invert_z()

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\ambient_test.zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")
        object.set_animation_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Pose\\Female_A")
        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "fbx")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()

    #this function is example for multi process 
    def example_change_axis(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")

        #Set exporting options (Axis Conversion option) of string type
        object.set_export_axis_x("X")
        object.set_export_axis_y("Z")
        object.set_export_axis_z("Y")

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\Women_Set.zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")
        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "obj")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()

    #this function is example for serial multiple process  
    def run_multi_second_example(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()
        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")
        #Set importing options (fps) of integer type
        object.set_import_fps(30)
        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")
        #Set exporting options (fps) of integer type
        object.set_export_fps(30)
        #Set exporting options (unified UV coordinates option) without unified textures
        #object.set_export_unified_uv_texcoordnate(False)
        #object.set_export_unified_uv_texcoordnate(True, 1000, 5)
        #Set exporting options (thin option)
        object.on_export_thin()
        #Set exporting options (unweld option)
        object.on_export_unweld()
        #Set Save Zpac File With MetaData 
        object.on_save_zprj_with_metadata_info(True, 9, 0)
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\Women_Set.zpac")
        #set path of one avatar file
        #alembic does not need an avatar file.
        #If you use a different format, delete "#"
        #set folder path of multiple animation folder and extension (file extension must be supported by Marvelous Designer)
        object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999", "abc")
        #must call object.sync_file_lists for serial multiple process
        object.sync_file_lists("animation")
        #next multi process
        #object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_3.0.9999\\Garment\\Women_Set.zpac")
        #object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_3.0.9999\\pose02", "abc")
        #object.sync_file_lists("animation")
        #next multi process
        #object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_3.0.9999\\Garment\\T-shirt_men.zpac")
        #object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_3.0.9999\\pose02", "abc")
        #object.sync_file_lists("animation")
        #next multi process
        #object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_3.0.9999\\Garment\\T-shirt_men.zpac")
        #object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_3.0.9999\\pose02", "abc")
        #object.sync_file_lists("animation")
        #setting file path for serial multiple process is done, designate path for save and extension
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "mc")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #Call the "process" function
        object.process()

    #this function is example for multi process 
    def run_example_texture_margin(self, object):
        # clear console window
        object.clear_console() 
        #initialize mdsa module
        object.initialize()

        #Set importing options (unit) of string type
        object.set_import_scale_unit("mm")

        #Set exporting options (unit) of string type
        object.set_export_scale_unit("mm")

        #Set exporting options (unified UV coordinates option)
        # first value : Unified Textures of boolean type
        # second value : Texture Size(Width & Height) of integer type
        # third value : Fill Texture Seams of integer type
        # fourth value : Texture Margin Property
        #               True(absolute length(mm)) , False(relative uv coordinate (0-1))
        # fifth value : Texture Margin Value
        object.set_export_unified_uv_texcoordnate(True, 1000, 5, True, 0.1)

        #In case want to simulate/record one garment and avatar with multiple animation
        #set path of one garment file
        object.set_garment_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Garment\\ambient_test.zpac")

        #set path of one avatar file
        object.set_avatar_file_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Avatar\\Female_A\\Female_A_V3.avt")
        #set folder path of multiple animation folder and extension (file extension must be supported by Marvelous Designer)
        object.set_animation_folder("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Avatar\\Pose\\Female_A", "pos")
        #set save folder and extension (file extension must be supported by Marvelous Designer)
        object.set_save_folder_path("C:\\Users\\Public\\Documents\\MarvelousDesigner\\Assets_ver_5.1.99999\\Output", "fbx")
        #set auto save option. True is save with Zprj File and Image File.
        object.set_auto_save(False)
        #call the "process" function (to autosave project file, change factor to ture)
        object.process()


    def set_mdsa(self, object):
            self.mdsa = object