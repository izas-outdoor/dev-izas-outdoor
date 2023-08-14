from MVPython import MarvelousDesignerAPI
from MVPython.MarvelousDesignerAPI import *
import os
#MarvelousDesigner Python Script Module
#Auther : MD Team Developer
#mdsa = Marvelous Designer Script API

class MarvelousDesigner:
    open_avatar_file_list = []
    open_garment_file_list = []
    open_animation_file_list = []
    open_fabric_file_list = []
    save_file_path_list = []
    obj_type_list = []
    simulation_quality_list = []
    simulation_delay_time_list = []
    save_folder_path = ""
    save_fabric_folder_path = ""
    save_capture_image_folder_path = ""
    save_file_extension = ""
    save_image_folder_path = ""
    avatar_skin_offset = 3.0

    #Initialize export OBJ option
    export_scale_unit = "none"
    import_scale_unit = "none"
    export_fps = 30
    import_fps = 30
    export_weld = False
    export_thin = True

    export_include_pattern = False
    export_include_piping_pattern = False
    export_include_zipper_teeth_pattern = False
    export_include_avatar = False
    export_include_trim = False
    export_include_graphics = False
    export_include_top_stitch = False
    export_include_zipper_puller_and_slider = False
    export_include_button_hole = False
    export_include_button_head = False
    export_include_obj_stitch = False

    export_unified_uv_coordinates = False
    export_unified_texture = False
    export_texture_size = 1000
    export_fill_texture_seams = 5
    export_texture_bake_margin = 0.01
    export_texture_bake_relateive = True

    export_single_object = True
    export_save_with_texture = False
    export_diffuse_color_combined = False
    export_exclude_ambient_color = False
    export_include_inner_shape = False
    export_save_meta_data = False

    export_axis_x = 0
    export_axis_y = 1
    export_axis_z = 2
    export_invert_x = False
    export_invert_y = False
    export_invert_z = False



    #Initialize Normal preset Simulation Property
    simulation_quality = 1
    simulation_time_step = 0.033333
    simulation_number_of_simulation = 1
    simulation_cg_finish_condition = 0
    simulation_cg_iteration_count = 50
    simulation_cg_residual = 0.000100
    simulation_self_collision_iteration_count = 1
    simulation_air_damping = 1.0
    simulation_gravity = -9800.00
    simulation_number_of_cpu_in_use = 4
    simulation_nonlinear_simulation = False
    simulation_ground_collision = True
    simulation_ground_height = 0.0
    simulation_avatar_cloth_collision_detection_triangle_vertex = True
    simulation_self_collision_detection_triangle_vertex = True
    simulation_self_collision_detection_edge_edge = True
    simulation_self_collision_detection_avoidance_stiffness = 0.001000
    simulation_proximity_detection_vertex_triangle = True
    simulation_proximity_detection_edge_edge = True
    simulation_intersection_resolution = True
    simulation_layer_based_collision_detection = True

    #Initalize wind controller property
    wind_activate = False
    wind_type = 1
    wind_strength = 1000.00
    wind_decay = 0.00
    wind_frequency = 0.00
    wind_turbulence = 30.00
    wind_x = -700.00
    wind_y = 1000.00
    wind_z = 300.00

    capture_width = 1920
    capture_height = 1080

    go_first_frame = False
    go_end_frame = False

    recive_widget = None
    recive_function = None
    test_cylinder = True
    bOgawa = False
    auto_save_zprj_file = True
    file_load_complete = False
    finish_play_animation = False
    finish_recording_animation = False
    job_tuple_list_= []
    save_frame_list_ = []
    save_obj_sequence = False
    time_warp = 1.0
    updateTimeWarp = False

    __current_process = 0
    __sub_process = 0
    __module_obj = MarvelousDesignerModule()

    def initialize(object):
        object.__module_obj.InitProcess()
        object.open_avatar_file_list = []
        object.open_garment_file_list = []
        object.open_animation_file_list = []
        object.open_fabric_file_list = []
        object.save_file_path_list = []
        object.save_folder_path = ""
        object.save_fabric_folder_path = ""
        object.save_image_folder_path = ""
        object.save_file_extension = "zprj"
        object.save_capture_image_folder_path = ""
        object.obj_type_list = []
        object.simulation_quality_list = []
        object.simulation_delay_time_list = []
        object.job_tuple_list_ = []
        object.save_frame_list_ = []
        object.__current_process = 0
        object.__sub_process = 0
        object.check_process = 0

        #Initialize Export Option
        object.export_scale_unit = "none"
        object.import_scale_unit = "none"
        object.export_fps = 30
        object.export_weld = False
        object.export_thin = True
        object.export_unified_uv_coordinates = False
        object.export_unified_texture = False
        object.export_texture_size = 1000
        object.export_fill_texture_seams = 5
        object.export_texture_bake_margin = 0.01
        object.export_texture_bake_relateive = True
        object.import_fps = 30
        object.avatar_skin_offset = 3.0
        object.export_single_object = True
        object.export_save_with_texture = False
        object.export_diffuse_color_combined = False
        object.export_exclude_ambient_color = False
        object.export_include_inner_shape = False
        object.export_save_meta_data = False
        object.export_axis_x = 0
        object.export_axis_y = 1
        object.export_axis_z = 2
        object.export_invert_x = False
        object.export_invert_y = False
        object.export_invert_z = False
        object.save_obj_sequence = False

        object.go_first_frame = False
        object.go_end_frame = False
        object.time_warp = 1.0
        object.updateTimeWarp = False
        #Initialize Only Export Option
        object.export_include_pattern = False
        object.export_include_piping_pattern = False
        object.export_include_zipper_teeth_pattern = False
        object.export_include_avatar = False
        object.export_include_trim = False
        object.export_include_graphics = False
        object.export_include_top_stitch = False
        object.export_include_zipper_puller_and_slider = False
        object.export_include_button_hole = False
        object.export_include_button_head = False
        object.export_include_obj_stitch = False
        object.capture_width = 1920
        object.capture_height = 1080
        object.test_cylinder = True

        #Initialize Normal(Default) preset Simulation Property
        object.simulation_quality = 1
        object.simulation_time_step = 0.033333
        object.simulation_number_of_simulation = 1
        object.simulation_cg_finish_condition = 0
        object.simulation_cg_iteration_count = 50
        object.simulation_cg_residual = 0.000100
        object.simulation_self_collision_iteration_count = 1
        object.simulation_air_damping = 1.0
        object.simulation_gravity = -9800.00
        object.simulation_number_of_cpu_in_use = 4
        object.simulation_nonlinear_simulation = False
        object.simulation_ground_collision = True
        object.simulation_ground_height = 0.0
        object.simulation_avatar_cloth_collision_detection_triangle_vertex = True
        object.simulation_self_collision_detection_triangle_vertex = True
        object.simulation_self_collision_detection_edge_edge = True
        object.simulation_self_collision_detection_avoidance_stiffness = 0.001000
        object.simulation_proximity_detection_vertex_triangle = True
        object.simulation_proximity_detection_edge_edge = True
        object.simulation_intersection_resolution = True
        object.simulation_layer_based_collision_detection = True

        #Initalize wind controller property
        object.wind_activate = False
        object.wind_type = 1
        object.wind_strength = 1000.00
        object.wind_decay = 0.00
        object.wind_frequency = 0.00
        object.wind_turbulence = 30.00
        object.wind_x = -700.00
        object.wind_y = 1000.00
        object.wind_z = 300.00

        object.__module_obj.SetMoveGarment(False)

    #clear for console window
    def clear_console(object):
        object.__module_obj.Clear()

    def get_split_string(object, string, split_filter_list):
        split_string = []
        if string != "":
            for char in split_filter_list:
                split_string = string.split(char)
                if len(split_string) > 1:
                    break

        return split_string

    def get_file_name(object, file_path):
        split_filter_list = ["\\", "/"]
        split_string = object.get_split_string(file_path, split_filter_list)
        if len(split_string) > 0:
            return split_string[len(split_string) - 1]
        else:
            print("Error: file name")

    def get_file_name_except_ext(object, file_path):
        split_filter_list = ["\\", "/"]
        split_string = object.get_split_string(file_path, split_filter_list)
        if len(split_string) > 0:
            file_name = split_string[len(split_string) - 1]
            if file_name != "":
                split_save_path = file_name.split('.')
                ext = split_save_path[len(split_save_path)-1]
                #save_file_path = save_file_path.replace(ext, 'zprj', -1)
                head, _sep, tail = file_name.rpartition(ext)
                file_name = head[:-1]

            return file_name
        else:
            print("Error: file name")

    def get_filter_file_name(object, file_list, filter):
        new_file_list = []
        for string in file_list:
            split_string = string.split(".")
            if split_string[len(split_string)-1].lower() == filter.lower():
                new_file_list.append(string)

        return new_file_list

    def make_valid_folder_path(object, folder_path):
        split_string = []
        for char in folder_path:
            if char == ' ':
                continue
            split_string.append(char)
        if split_string[len(split_string)-1] != "\\" and split_string[len(split_string)-1] != "/":
            print("Warning: not found last character / \n")
            folder_path = folder_path + "\\"

        return folder_path

    def get_entry_list(object, folder_path):
        if os.path.isdir(object.make_valid_folder_path(folder_path)) == False:
            print("Warning: Not exist Folder Path\n")
            return entry_list
        else:
            entry_list = os.listdir(object.make_valid_folder_path(folder_path))
            return entry_list

        return entry_list

    def set_open_option(object, unit = "none", fps = 30):
        object.import_scale_unit = unit
        object.import_fps = fps

    def set_save_option(object, unit = "none", fps = 30, unified = False, thin = True, weld = False):
        object.export_scale_unit = unit
        object.export_fps = fps
        object.export_unified_uv_coordinates = unified
        object.export_thin = thin
        object.export_weld = weld

    def run_app_open_option(object):
        if object.import_scale_unit == "cm":
            object.__module_obj.SetScale(10)

        elif object.import_scale_unit == "mm":
            object.__module_obj.SetScale(1)

        elif object.import_scale_unit == "inch":
            object.__module_obj.SetScale(25.4)

        elif object.import_scale_unit == "feet":
            object.__module_obj.SetScale(304.8)

        elif object.import_scale_unit == "m":
            object.__module_obj.SetScale(1000)

        else:
            object.__module_obj.SetScale(1)

        object.__module_obj.SetFps(object.import_fps)

    def run_app_save_option(object):
        if object.export_scale_unit == "cm":
            object.__module_obj.SetScale(0.1)

        elif object.export_scale_unit == "mm":
            object.__module_obj.SetScale(1)

        elif object.export_scale_unit == "inch":
            object.__module_obj.SetScale(0.03937)

        elif object.export_scale_unit == "feet":
            object.__module_obj.SetScale(0.00328084)

        elif object.export_scale_unit == "m":
            object.__module_obj.SetScale(0.001)

        else:
            object.__module_obj.SetScale(1)

        object.__module_obj.SetFps(object.export_fps)

        #include Export Option
        if object.export_include_pattern == True:
            object.__module_obj.SetIncludeExportOptionPattern()

        if object.export_include_piping_pattern == True:
            object.__module_obj.SetIncludeExportOptionPipingPattern()

        if object.export_include_zipper_teeth_pattern == True:
            object.__module_obj.SetIncludeExportOptionZipperTeethPattern()

        if object.export_include_avatar == True:
            object.__module_obj.SetIncludeExportOptionAvatar()

        if object.export_include_trim == True:
            object.__module_obj.SetIncludeExportOptionTrim()

        if object.export_include_graphics == True:
            object.__module_obj.SetIncludeExportOptionGraphics()

        if object.export_include_top_stitch == True:
            object.__module_obj.SetIncludeExportOptionTopStitch()

        if object.export_include_zipper_puller_and_slider == True:
            object.__module_obj.SetIncludeExportOptionZipperPullerAndSlider()

        if object.export_include_button_hole == True:
            object.__module_obj.SetIncludeExportOptionButtonHole()

        if object.export_include_button_head == True:
            object.__module_obj.SetIncludeExportOptionButtonHead()

        if object.export_include_obj_stitch == True:
            object.__module_obj.SetIncludeExportOptionOBJStitch()

        # Change Frame
        if object.go_first_frame == True:
            object.__module_obj.GoFirstFrame()

        elif object.go_end_frame == True:
            object.__module_obj.GoEndFrame()

        # Unified Texture Option
        object.__module_obj.SetUnifiedUVMap(object.export_unified_uv_coordinates)
        object.__module_obj.SetTextureBake(object.export_unified_texture)
        object.__module_obj.SetTextureBakeSize(object.export_texture_size)
        object.__module_obj.SetFillTextureSeam(object.export_fill_texture_seams)
        object.__module_obj.SetTextureBakeMargin(object.export_texture_bake_margin)
        object.__module_obj.SetTextureBakeRelateive(object.export_texture_bake_relateive)

        # Set export option
        object.__module_obj.SetSingleObject(object.export_single_object)
        object.__module_obj.SetSaveWithTexture(object.export_save_with_texture)
        object.__module_obj.SetDiffuseColorCombined(object.export_diffuse_color_combined)
        object.__module_obj.SetExcludeAmbientColor(object.export_exclude_ambient_color)
        object.__module_obj.SetIncludeInnerShape(object.export_include_inner_shape)
        object.__module_obj.SetSaveMetaData(object.export_save_meta_data)
        object.__module_obj.SetWeld(object.export_weld)
        object.__module_obj.SetThin(object.export_thin)

        object.__module_obj.SetAxisX(object.export_axis_x)
        object.__module_obj.SetAxisY(object.export_axis_y)
        object.__module_obj.SetAxisZ(object.export_axis_z)
        object.__module_obj.SetInvertX(object.export_invert_x)
        object.__module_obj.SetInvertY(object.export_invert_y)
        object.__module_obj.SetInvertZ(object.export_invert_z)

    def set_avatar_file_path(object, open_avatar_file_path):
        object.open_avatar_file_list.append(open_avatar_file_path)

    def set_avatar_file_path_list(object, open_avatar_file_path_list):
        object.open_avatar_file_list = open_avatar_file_path_list

    def set_garment_file_path(object, open_garment_file_path):
        object.open_garment_file_list.append(open_garment_file_path)

    def set_garment_file_path_list(object, open_garment_file_path_list):
        object.open_garment_file_list = open_garment_file_path_list

    def set_animation_file_path(object, open_animation_file_path):
        object.open_animation_file_list.append(open_animation_file_path)

    def set_animation_file_path_list(object, open_animation_file_path_list):
        object.open_animation_file_list = open_animation_file_path_list

    def set_simulation_options(object, obj_type = 0, simulation_quality = 0, simulation_delay_time = 5000):
        object.obj_type_list.append(obj_type)
        object.simulation_quality_list.append(simulation_quality)
        object.simulation_delay_time_list.append(simulation_delay_time)

    def set_save_file_path(object, save_file_path):
        object.save_file_path_list.append(save_file_path)

    def set_save_folder_path(object, save_folder_path, extension = "zprj"):
        object.save_folder_path = object.make_valid_folder_path(save_folder_path)
        if(os.path.isdir(object.save_folder_path) == False):
            os.mkdir(object.save_folder_path)

        object.save_file_extension = extension

    def setSaveImageFolderPath(object, targetFolder):
        object.save_image_folder_path = object.make_valid_folder_path(targetFolder)
        if(os.path.isdir(object.save_image_folder_path) == False):
            os.mkdir(object.save_image_folder_path)

    def is_finished_simulation(object):
        return object.__module_obj.IsFinishProcess()

    def avatar_file_open(object, open_file_path, obj_type = 0, scale = "mm", fps = 30):
        if open_file_path != "":
            object.__module_obj.NewAvatar()
            object.set_open_option(scale, fps)
            object.run_app_open_option()
            object.__module_obj.OpenFile(open_file_path, obj_type)

    def garment_file_open(object, open_file_path):
        if open_file_path != "":
            object.__module_obj.NewGarment()
            object.__module_obj.OpenFile(open_file_path, 0)

    def animation_file_open(object, open_file_path, scale = "mm", fps = 30):
        if open_file_path != "":
            object.__module_obj.DeleteAnimation()
            object.set_open_option(scale, fps)
            object.run_app_open_option()
            object.__module_obj.OpenFile(open_file_path, 0)

    def save_file_stand_alone(object, file_path, scale = "mm", fps = 30, unfined_map = True):
        object.set_save_option(scale, fps, unfined_map)
        object.run_app_save_option()
        object.__module_obj.SaveFile(file_path, object.bOgawa)

    def SimulationOn(object, time):
        object.__module_obj.SimulationOn(time)

    def SimulationOff(object, time, signal_on = False):
        object.__module_obj.SetScreenCaptureFlag(signal_on)
        object.__module_obj.SimulationOff(time)

    def SimulationOffWithNextFunction(object, time, signal_on = False, next_function = True):
        object.__module_obj.SetScreenCaptureFlag(signal_on)
        object.__module_obj.SetNextProcessFlag(next_function)
        object.__module_obj.SimulationOff(time)

    def SimulationSetting(object):
        object.__module_obj.SetSimulationQuality(object.simulation_quality)
        object.__module_obj.SetSimulationTimeStep(object.simulation_time_step)
        object.__module_obj.SetSimulationNumberOfSimulation(object.simulation_number_of_simulation)
        object.__module_obj.SetSimulationCGFinishCondition(object.simulation_cg_finish_condition)
        object.__module_obj.SetSimulationCGIterationCount(object.simulation_cg_iteration_count)
        object.__module_obj.SetSimulationCGResidual(object.simulation_cg_residual)
        object.__module_obj.SetSimulationSelfCollisionIterationCount(object.simulation_self_collision_iteration_count)
        object.__module_obj.SetSimulationAirDamping(object.simulation_air_damping)
        object.__module_obj.SetSimulationGravity(object.simulation_gravity)
        object.__module_obj.SetSimulationNumberOfCPUInUse(object.simulation_number_of_cpu_in_use)
        object.__module_obj.SetSimulationNonlinearSimulation(object.simulation_nonlinear_simulation)
        object.__module_obj.SetSimulationGround_Collision(object.simulation_ground_collision)
        object.__module_obj.SetSimulationGround_Height(object.simulation_ground_height)
        object.__module_obj.SetSimulationAvatarClothCollisionDetection_TriangleVertex(object.simulation_avatar_cloth_collision_detection_triangle_vertex)
        object.__module_obj.SetSimulationSelfCollisionDetection_TriangleVertex(object.simulation_self_collision_detection_triangle_vertex)
        object.__module_obj.SetSimulationSelfCollisionDetection_EdgeEdge(object.simulation_self_collision_detection_edge_edge)
        object.__module_obj.SetSimulationSelfCollisionDetection_AvoidanceStiffness(object.simulation_self_collision_detection_avoidance_stiffness)
        object.__module_obj.SetSimulationProximityDetection_VertexTriangle(object.simulation_proximity_detection_vertex_triangle)
        object.__module_obj.SetSimulationProximityDetection_EdgeEdge(object.simulation_proximity_detection_edge_edge)
        object.__module_obj.SetSimulationIntersectionResolution(object.simulation_intersection_resolution)
        object.__module_obj.SetSimulationLayerBasedCollisionDetection(object.simulation_layer_based_collision_detection)
        object.__module_obj.UpdateSimulation()

    def StartAnimationRecord(object, time):
        object.__module_obj.StartAnimationRecordOfStandAlone(time)

    def single_process(object, open_garment_path = "", open_avatar_path = "", open_animation_path = "", save_file_path = "", obj_type = 0, simulation_delay_time = 5000, simulation_quality = 0, simulation = True, auto_save_project_file = True):

        if simulation:
            if object.is_finished_simulation():
                print("Warning: pre process is not finished. please retry after finishing pre preocess \n")
                return False

        object.run_app_open_option()

        if open_garment_path != "":
            object.__module_obj.NewGarment()

        if open_avatar_path != "":
            object.__module_obj.NewAvatar()

        if open_animation_path != "":
            object.__module_obj.DeleteAnimation()

        if open_garment_path != "":
            object.__module_obj.OpenFile(open_garment_path, obj_type)

        if open_avatar_path != "":
            object.__module_obj.OpenFile(open_avatar_path, obj_type)

        if open_animation_path != "":
            object.__module_obj.OpenFile(open_animation_path, obj_type)

        if save_file_path == "":
            if object.save_folder_path != "":
                if os.path.isdir(object.save_folder_path) == True:
                    split_filter_list = ["\\", "/"]
                    split_string = object.get_split_string(open_garment_path, split_filter_list)
                    if len(split_string) < 2:
                        split_string = object.get_split_string(open_avatar_path, split_filter_list)
                        if len(split_string) < 2:
                            split_string = object.get_split_string(open_animation_path, split_filter_list)

                    save_file_path = object.save_folder_path + split_string[len(split_string)-1]
                    object.__module_obj.SetSaveFilePath(save_file_path, object.save_file_extension, True)
            else:
                print("Warning: save file path is null \n")
        else:
            object.__module_obj.SetSaveFilePath(save_file_path, object.save_file_extension, False)

        zprj_file_path = save_file_path
        split_save_path = zprj_file_path.split('.')
        ext = split_save_path[len(split_save_path)-1]

        if auto_save_project_file == True:
            if ext != 'zprj':
                head, _sep, tail = zprj_file_path.rpartition(ext)
                zprj_file_path = head + 'zprj'

        if auto_save_project_file == True:
            object.__module_obj.SetSaveZprjFilePath(zprj_file_path)

        object.__module_obj.SetSimulationQuality(simulation_quality)
        if simulation:
            object.__module_obj.SimulationOn(0)
            object.__module_obj.SimulationOff(simulation_delay_time)
            object.UpdateTimeWarp()
            object.__module_obj.StartAnimationRecord(simulation_delay_time, True)

    def save_single_file(object):
         object.run_app_save_option()
         object.__module_obj.SaveFile(object.__module_obj.GetSaveFilePath(), object.save_obj_sequence, object.bOgawa)
         project_file_path = object.__module_obj.GetSaveZpacFilePath()

         if project_file_path != "":
             object.__module_obj.SaveFile(object.__module_obj.GetSaveZpacFilePath())

    def process(object):
        object.run_app_open_option()

        obj_type = 0

        if len(object.obj_type_list) > object.__current_process:
            obj_type = object.obj_type_list[object.__current_process]

        if len(object.open_avatar_file_list) <= 0:
            print("Warning: Avatar file path is null. if you want loding avatar, you must set file path in avatar_file_list\n")
            object.__module_obj.NewAvatar()
        else:
            if len(object.open_avatar_file_list) > object.__current_process:
                if object.open_avatar_file_list[object.__current_process] != "":
                    object.__module_obj.NewAvatar()
                    object.__module_obj.OpenFile(object.open_avatar_file_list[object.__current_process], obj_type)
            else:
                if object.open_avatar_file_list[len(object.open_avatar_file_list)-1] != "":
                    object.__module_obj.NewAvatar()
                    object.__module_obj.OpenFile(object.open_avatar_file_list[len(object.open_avatar_file_list)-1], obj_type)
            # Set Avatar skin offset
            object.__module_obj.SetAvatarSkinOffset(object.avatar_skin_offset)

        if len(object.open_garment_file_list) <= 0:
            print("Warning: Garment file path is null. if you want loding Garment, you must set file path in animation file list\n")
            object.__module_obj.NewGarment()
        else:
            if(len(object.open_garment_file_list) > object.__current_process):
                if object.open_garment_file_list[object.__current_process] != "":
                    object.__module_obj.NewGarment()
                    object.__module_obj.OpenFile(object.open_garment_file_list[object.__current_process], obj_type)
            else:
                if object.open_garment_file_list[len(object.open_garment_file_list)-1] != "":
                    object.__module_obj.NewGarment()
                    object.__module_obj.OpenFile(object.open_garment_file_list[len(object.open_garment_file_list)-1], obj_type)

        if len(object.open_animation_file_list) <= 0:
            print("Warning: Animation file path is null. if you want loding animation (or Pose), you must set file path in animation file list\n")
            object.__module_obj.DeleteAnimation()
            result = False

        else:
            if(len(object.open_animation_file_list) > object.__current_process):
                if object.open_animation_file_list[object.__current_process] != "":
                    object.__module_obj.DeleteAnimation()
                    result =  object.__module_obj.OpenFile(object.open_animation_file_list[object.__current_process], obj_type)
                else:
                    if object.open_garment_file_list[len(object.open_garment_file_list)-1] != "":
                        object.__module_obj.DeleteAnimation()
                        result = object.__module_obj.OpenFile(object.open_animation_file_list[len(object.open_animation_file_list)-1], obj_type)
                result = True
            else:
                result = False


        save_file_path = ""
        zprj_file_path = ""
        need_change_save_ext = False

        if len(object.save_file_path_list) <= object.__current_process:
            need_change_save_ext = True
        elif len(object.save_file_path_list) > object.__current_process:
            save_file_path = object.save_file_path_list[object.__current_process]


        if save_file_path == "":
            if object.save_folder_path != "":
                need_change_save_ext = True
                new_file_path = ""

                print("new File Path")
                if len(object.open_animation_file_list) > object.__current_process:
                    new_file_path = object.get_file_name(object.open_animation_file_list[object.__current_process])
                else:
                    if len(object.open_animation_file_list) != 0:
                        new_file_path = object.get_file_name(object.open_animation_file_list[len(object.open_animation_file_list) - 1])

                if new_file_path != "":
                    split_save_path = new_file_path.split('.')
                    ext = split_save_path[len(split_save_path)-1]
                    #save_file_path = save_file_path.replace(ext, 'zprj', -1)
                    head, _sep, tail = new_file_path.rpartition(ext)
                    new_file_path = head[:-1]

                print(new_file_path)
                if len(object.open_avatar_file_list) > object.__current_process:
                    new_file_path =  new_file_path + object.get_file_name(object.open_avatar_file_list[object.__current_process])
                else:
                    if len(object.open_avatar_file_list) != 0:
                        new_file_path = new_file_path + object.get_file_name(object.open_avatar_file_list[len(object.open_avatar_file_list) - 1])

                if new_file_path != "":
                    split_save_path = new_file_path.split('.')
                    ext = split_save_path[len(split_save_path)-1]
                    #save_file_path = save_file_path.replace(ext, 'zprj', -1)
                    head, _sep, tail = new_file_path.rpartition(ext)
                    new_file_path = head[:-1]

                print(new_file_path)
                if len(object.open_garment_file_list) > object.__current_process:
                    new_file_path =  new_file_path + object.get_file_name(object.open_garment_file_list[object.__current_process])
                else:
                    if len(object.open_garment_file_list) != 0:
                        new_file_path = new_file_path + object.get_file_name(object.open_garment_file_list[len(object.open_garment_file_list) - 1])

                print(new_file_path)

                if os.path.isdir(object.save_folder_path)  == True:
                    save_file_path = object.save_folder_path + object.get_file_name(new_file_path)
            else:
                print("Warning: save file path is null \n")

        if save_file_path == "":
            print("Error: file path is not found\n")
            return

        if save_file_path != "" and need_change_save_ext == True:
            split_save_path = save_file_path.split('.')
            ext = split_save_path[len(split_save_path)-1]
            #save_file_path = save_file_path.replace(ext, 'zprj', -1)
            head, _sep, tail = save_file_path.rpartition(ext)
            save_file_path = head + object.save_file_extension

        zprj_file_path = save_file_path
        if need_change_save_ext != False and object.auto_save_zprj_file == True:
            print("Auto Save Zprj")
            split_save_path = zprj_file_path.split('.')
            ext = split_save_path[len(split_save_path)-1]

            if ext != 'zprj':
                head, _sep, tail = zprj_file_path.rpartition(ext)
                zprj_file_path = head + 'zprj'
                #zprj_file_path = zprj_file_path.replace(ext, 'zprj', -1)

            object.__module_obj.SetSaveZprjFilePath(zprj_file_path)


        object.__module_obj.SetSaveFilePath(save_file_path, object.save_file_extension, False)

        #simulation_quality = 0

        #if len(object.simulation_quality_list) > object.__current_process:
            #simulation_quality = object.simulation_quality_list[object.__current_process]

        #object.__module_obj.SetSimulationQuality(simulation_quality)

        simulation_delay_time = 3000

        if len(object.simulation_delay_time_list) > object.__current_process:
            simulation_delay_time = object.simulation_delay_time_list[object.__current_process]

        object.SimulationSetting()
        # Wind Cotroller Option
        object.on_windcontroller()
        object.__module_obj.SimulationOn(0)
        object.__module_obj.SimulationOff(simulation_delay_time)
        object.UpdateTimeWarp()
        object.__module_obj.StartAnimationRecord(simulation_delay_time, False)

    def set_garment_folder(object, garment_folder_path, filter = "zpac"):
        garment_file_list = []
        if filter != "":
            garment_file_list = object.get_filter_file_name(object.get_entry_list(garment_folder_path), filter)

        if len(garment_file_list) < 1:
            print("Warning: The Garment file does not exist.\n")
            return

        for i in range(0, len(garment_file_list)):
            garment_file_list[i] = garment_folder_path + "\\" + garment_file_list[i]

        for file in garment_file_list:
            object.open_garment_file_list.append(file)

    def set_avatar_folder(object, avatar_folder_path, filter = "avt"):
        avatar_file_list = []
        if filter != "":
            avatar_file_list = object.get_filter_file_name(object.get_entry_list(avatar_folder_path), filter)

        if len(avatar_file_list) < 1:
            print("Warning: The Avatar file does not exist.\n")
            return

        for i in range(0, len(avatar_file_list)):
            avatar_file_list[i] = avatar_folder_path + "\\"  + avatar_file_list[i]

        for file in avatar_file_list:
            object.open_avatar_file_list.append(file)

    def set_animation_folder(object, animation_folder_path, filter = "pos"):
        animation_file_list = []
        if filter != "":
            animation_file_list = object.get_filter_file_name(object.get_entry_list(animation_folder_path), filter)

        if len(animation_file_list) < 1:
            print("Warning: The Animation file does not exist.\n")
            return

        for i in range(0, len(animation_file_list)):
            animation_file_list[i] = animation_folder_path + "\\"  + animation_file_list[i]

        for file in animation_file_list:
            object.open_animation_file_list.append(file)

    def set_fabric_folder(object, fabric_folder_path, filter = "zfab"):
        object.save_fabric_folder_path = object.make_valid_folder_path(fabric_folder_path)
        fabric_file_list = []
        if filter != "":
            fabric_file_list = object.get_filter_file_name(object.get_entry_list(fabric_folder_path), filter)

        if len(fabric_file_list) < 1:
            print("Warning: The Fabric file does not exist.\n")
            return

        for i in range(0, len(fabric_file_list)):
            fabric_file_list[i] = fabric_folder_path + "\\"  + fabric_file_list[i]

        for file in fabric_file_list:
            object.open_fabric_file_list.append(file)

    def append_path_in_list(object, source_list, target_list):
        result_list = []
        max = len(target_list)

        if max == 0:
            return result_list

        for i in range(max, len(source_list)):
                target_list.append(target_list[len(target_list)-1])

        result_list = target_list
        return result_list

    def sync_file_lists(object, target):
        if target == "animation":
            object.open_garment_file_list = object.append_path_in_list(object.open_animation_file_list, object.open_garment_file_list)
            object.open_avatar_file_list = object.append_path_in_list(object.open_animation_file_list, object.open_avatar_file_list)
        elif target == "avatar":
            object.open_garment_file_list = object.append_path_in_list(object.open_avatar_file_list, object.open_garment_file_list)
            object.open_animation_file_list = object.append_path_in_list(object.open_avatar_file_list, object.open_animation_file_list)
        elif target == "garment":
            object.open_avatar_file_list = object.append_path_in_list(object.open_garment_file_list, object.open_avatar_file_list)
            object.open_animation_file_list = object.append_path_in_list(object.open_garment_file_list, object.open_animation_file_list)
        else:
            print("Error: Unknown Target")

    def get_max_count(object):
        max_count = len(object.open_garment_file_list)
        if max_count < len(object.open_avatar_file_list):
            max_count = len(object.open_avatar_file_list)
        if max_count < len(object.open_animation_file_list):
            max_count = len(object.open_animation_file_list)

        return max_count


    def save_file(object, screen_capture = False, single_save = False):
        print("save file")
        object.run_app_save_option()

        object.__module_obj.SaveFile(object.__module_obj.GetSaveFilePath(), False, object.bOgawa)

        if object.auto_save_zprj_file == True:
            project_file_path = object.__module_obj.GetSaveZpacFilePath()
            if project_file_path != "" and project_file_path != object.__module_obj.GetSaveFilePath():
                object.__module_obj.SaveFile(project_file_path)

        object.__current_process = object.__current_process + 1
        max_count = object.get_max_count()

        if object.recive_function != None:
            object.recive_function()

        if single_save == False:
            if object.__current_process < max_count:
                object.process()
        #else:
        #   message_box = QtGui.QMessageBox()
        #   message_box.setText("Finish Process")
        #   message_box.setDefaultButton(QtGui.QMessageBox.Ok)
        #   message_box.show()

    def convert_int_to_py(object, value):
        return object.__module_obj.ConvertQObjectToPy(value, 0)

    def convert_float_to_py(object, value):
        return object.__module_obj.ConvertQObjectToPy(value, 1)

    def convert_qstring_to_py(object, value):
        return object.__module_obj.ConvertQObjectToPy(value, 2)

    def convert_bool_to_py(object, value):
        return object.__module_obj.ConvertQObjectToPy(value, 3)

    def set_recive_widget(object, widget):
        object.recive_widget = widget

    def set_recive_function(object, function):
        object.recive_function = function

    def set_auto_save(object, bAutoSave):
        object.auto_save_zprj_file = bAutoSave

    #save_type = 0 is folder, save_type = 1 is Zip File
    def on_save_zprj_with_metadata_info(object, bWith_meta_data, image_number, save_type):
        object.__module_obj.SetWithMetaData(bWith_meta_data, image_number, save_type)

    def load_fabric_file(object, file_path):
        object.__module_obj.LoadZfabFile(file_path)

    def create_auto_pin(object):
        object.__module_obj.CreateTemporaryPin()

    def remove_all_pin(object):
        object.__module_obj.RemoveAllPin()

    def set_particle_distance(object, value):
        object.__module_obj.SetParticleDistance(value)

    def set_capture_screen_width_and_height(object, width, height):
        object.capture_width = width
        object.capture_height = height

    def capture_screen(object, file_path):
        object.__module_obj.CaptureScreen(object.capture_width, object.capture_height, file_path)

    def set_capture_image_save_folder(object, folder_path):
        object.save_capture_image_folder_path = object.make_valid_folder_path(folder_path)

    def physical_process(object, cylinder):
        object.__module_obj.InitProcess()
        object.garment_file_open(object.open_garment_file_list[object.__sub_process])
        object.test_cylinder = cylinder
        if cylinder:
            object.create_auto_pin()
            object.load_fabric_file(object.open_fabric_file_list[object.__current_process])
            object.__module_obj.MoveUpGarment(0)
            object.set_simulation_quality(3) #0 Complete, 1 Normal, 2 Custom, 3 NonLinier
            object.set_particle_distance(10.0)
        else:
            object.garment_file_open(object.open_garment_file_list[object.__sub_process])
            object.load_fabric_file(object.open_fabric_file_list[object.__current_process])
            object.set_simulation_quality(3) #0 Complete, 1 Normal, 2 Custom, 3 NonLinier
            object.set_strengthen(True)

        object.SimulationOn(0)
        object.SimulationOffWithNextFunction(5000, False, True)

    def _physical_second_process(object):
        object.__module_obj.InitProcess()

        if object.test_cylinder:
            object.remove_all_pin()
            object.set_particle_distance(5.0)
        else:
            #object.set_simulation_quality(3); #0 Complete, 1 Normal, 2 Custom, 3 NonLinier
            object.set_strengthen(False)
            object.move_up_garment()

        object.SimulationOn(0)
        object.SimulationOff(2000, True)

    def front_avatar(object):
        object.__module_obj.FrontCamera()

    def set_strengthen(object, active):
        object.__module_obj.SetStrengthen(active)

    def move_up_garment(object):
        object.__module_obj.MoveUpGarment(10)

    def set_alembic_format_type(object, ogawa = False):
        object.bOgawa = ogawa

    def save_test_file(object, screen_capture = False):
        save_file_path = ""
        print("start save")
        if object.save_folder_path != "":
            if os.path.isdir(object.save_folder_path) == True:
                save_file_path = object.save_folder_path + object.get_file_name(object.open_fabric_file_list[object.__current_process])
            else:
                print("Warning: save file path is null \n")

        print("save_file_path:" + save_file_path)
        if save_file_path == "":
            print("Error: file path is not found\n")
            return

        if save_file_path != "":
            split_save_path = save_file_path.split('.')
            ext = split_save_path[len(split_save_path)-1]
            #save_file_path = save_file_path.replace(ext, 'zprj', -1)
            head, _sep, tail = save_file_path.rpartition(ext)
            save_file_path = head + "zprj"

        object.__module_obj.SetSaveFilePath(save_file_path, "zprj", False, False)
        print("GetSaveFilePath:" + object.__module_obj.GetSaveFilePath())
        object.__module_obj.SaveFile(object.__module_obj.GetSaveFilePath(), object.bOgawa)

        if screen_capture:
            image_file_path = ""

            if os.path.isdir(object.save_capture_image_folder_path) == True:
                image_file_path = object.save_capture_image_folder_path + object.get_file_name(object.open_fabric_file_list[object.__current_process])

            if image_file_path == "":
                print("Error: file path is not found\n")

            if image_file_path != "":
                split_save_path = image_file_path.split('.')
                ext = split_save_path[len(split_save_path)-1]
                head, _sep, tail = image_file_path.rpartition(ext)
                image_file_path = head + "png"
            print("image_file_path:" + image_file_path)
            object.capture_screen(image_file_path)

        object.__sub_process = object.__sub_process + 1
        max_count = len(object.open_garment_file_list)
        if object.__sub_process < max_count:
            object.physical_process(object.test_cylinder)
        else:
            object.__sub_process = 0
            object.__current_process = object.__current_process + 1
            fabric_max_count = len(object.open_fabric_file_list)

            if object.__current_process < fabric_max_count:
                object.physical_process(object.test_cylinder)
            #else:
            #   message_box = QtGui.QMessageBox()
            #   message_box.setText("Finish Process")
            #   message_box.setDefaultButton(QtGui.QMessageBox.Ok)
            #   message_box.show()

    def on_export_garment_only(object):
        object.export_include_pattern = True

    def on_export_garment_with_relative_objects_only(object):
        object.export_include_pattern = True
        object.export_include_piping_pattern = True
        object.export_include_zipper_teeth_pattern = True
        object.export_include_trim = True
        object.export_include_graphics = True
        object.export_include_zipper_puller_and_slider = True
        object.export_include_button_hole = True
        object.export_include_button_head = True
        object.export_include_obj_stitch = True

    def on_export_avatar_only(object):
        object.export_include_avatar = True

    def on_export_piping_pattern_only(object):
        object.export_include_piping_pattern = True

    def on_export_zipper_teeth_pattern_only(object):
        object.export_include_zipper_teeth_pattern = True

    def on_export_trim_only(object):
        object.export_include_trim = True

    def on_export_graphics_only(object):
        object.export_include_graphics = True

    def on_export_zipper_puller_and_slider_only(object):
        object.export_include_zipper_puller_and_slider = True

    def on_export_button_hole_only(object):
        object.export_include_button_hole = True

    def on_export_button_head_only(object):
        object.export_include_button_head = True

    def on_export_obj_stitch_only(object):
        object.export_include_obj_stitch = True

    def on_export_single_object(object):
        object.export_single_object = True

    def on_export_multi_object(object):
        object.export_single_object = False

    def on_export_save_with_texture(object):
        object.export_save_with_texture = True

    def on_export_diffuse_color_combined(object):
        object.export_diffuse_color_combined = True

    def on_export_exclude_ambient_color(object):
        object.export_exclude_ambient_color = True

    def on_export_include_inner_shape(object):
        object.export_include_inner_shape = True

    def on_export_save_meta_data(object):
        object.export_save_meta_data = True

    def set_export_unified_uv_texcoordnate(object, bTextureBake, texture_bake_size = 1000, fill_texture_seam = 5, bTextureBake_relateive = True, texture_bake_margin = 0.01):
        object.export_unified_uv_coordinates = True
        object.export_unified_texture = bTextureBake
        object.export_texture_size = texture_bake_size
        object.export_fill_texture_seams = fill_texture_seam
        object.export_texture_bake_relateive = bTextureBake_relateive
        object.export_texture_bake_margin = texture_bake_margin

    def set_export_axis_x(object, axis):
        if axis == "x" or axis == "X" :
            object.export_axis_x = 0
        elif axis == "y" or axis == "Y" :
            object.export_axis_x = 1
        elif axis == "z" or axis == "Z" :
            object.export_axis_x = 2

    def set_export_axis_y(object, axis):
        if axis == "x" or axis == "X" :
            object.export_axis_y = 0
        elif axis == "y" or axis == "Y" :
            object.export_axis_y = 1
        elif axis == "z" or axis == "Z" :
            object.export_axis_y = 2

    def set_export_axis_z(object, axis):
        if axis == "x" or axis == "X" :
            object.export_axis_z = 0
        elif axis == "y" or axis == "Y" :
            object.export_axis_z = 1
        elif axis == "z" or axis == "Z" :
            object.export_axis_z = 2

    def on_export_invert_x(object):
        object.export_invert_x = True

    def on_export_invert_y(object):
        object.export_invert_y = True

    def on_export_invert_z(object):
        object.export_invert_z = True

    def set_import_scale_unit(object, unit):
        object.import_scale_unit = unit

    def set_export_scale_unit(object, unit):
        object.export_scale_unit = unit

    def set_import_fps(object, fps):
        object.import_fps = fps

    def set_export_fps(object, fps):
        object.export_fps = fps

    def on_export_thin(object):
        object.export_thin = True

    def on_export_thick(object):
        object.export_thin = False

    def on_export_weld(object):
        object.export_weld = True

    def on_export_unweld(object):
        object.export_weld = False

    def go_animation_first_frame(object):
        object.go_first_frame = True

    def go_animation_end_frame(object):
        object.go_end_frame = True

    # qulity = 0 Complete
    # qulity = 1 Normal
    # qulity = 2 Custom
    def set_simulation_quality(object, qulity):
        object.simulation_quality = qulity

    def set_simulation_time_step(object, time_step):
        object.simulation_time_step = time_step

    def set_simulation_number_of_simulation(object, number_of_Simulation):
        object.simulation_number_of_simulation = number_of_Simulation

    def set_simulation_cg_finish_condition(object, cg_finish_condition):
        object.simulation_cg_finish_condition = cg_finish_condition

    def set_simulation_cg_iteration_count(object, cg_iteration_count):
        object.simulation_cg_iteration_count = cg_iteration_count

    def set_simulation_cg_residual(object, cg_residual):
        object.simulation_cg_residual = cg_residual

    def set_simulation_self_collision_iteration_count(object, self_collision_iteration_count):
        object.simulation_self_collision_iteration_count = self_collision_iteration_count

    def set_simulation_air_damping(object, air_damping):
        object.simulation_air_damping = air_damping

    def set_simulation_gravity(object, gravity):
        object.simulation_gravity = gravity

    def set_simulation_number_of_cpu_in_use(object, number_of_cpu_in_use):
        object.simulation_number_of_cpu_in_use = number_of_cpu_in_use

    def set_simulation_nonlinear_simulation(object, bNonlinear_simulation):
        object.simulation_nonlinear_simulation = bNonlinear_simulation

    def set_simulation_ground_collision(object, bGround_collision):
        object.simulation_ground_collision = bGround_collision

    def set_simulation_ground_height(object, ground_height):
        object.simulation_ground_height = ground_height

    def set_simulation_avatar_cloth_collision_detection_triangle_vertex(object, bSolid_triangle_to_cloth_vertex_collision):
        object.simulation_avatar_cloth_collision_detection_triangle_vertex = bSolid_triangle_to_cloth_vertex_collision

    def set_simulation_self_collision_detection_triangle_vertex(object, bVertex_triangle_self_collision):
        object.simulation_self_collision_detection_triangle_vertex = bVertex_triangle_self_collision

    def set_simulation_self_collision_detection_edge_edge(object, bEdge_edge_self_collision):
        object.simulation_self_collision_detection_edge_edge = bEdge_edge_self_collision

    def set_simulation_self_collision_detection_avoidance_stiffness(object, self_collision_stiffness):
        object.simulation_self_collision_detection_avoidance_stiffness = self_collision_stiffness

    def set_simulation_proximity_detection_vertex_triangle(object, bVertex_triangle_proximity):
        object.simulation_proximity_detection_vertex_triangle = bVertex_triangle_proximity

    def set_simulation_proximity_detection_edge_edge(object, bEdge_edge_proximity):
        object.simulation_proximity_detection_edge_edge = bEdge_edge_proximity

    def set_simulation_intersection_resolution(object, bIntersection_resolution):
        object.simulation_intersection_resolution = bIntersection_resolution

    def set_simulation_layer_based_collision_detection(object, bUse_layer):
        object.simulation_layer_based_collision_detection = bUse_layer

    # wind controller
    def on_windcontroller(object):
        object.__module_obj.SetWindControllerWind_Activate(object.wind_activate)
        object.__module_obj.SetWindControllerWind_Type(object.wind_type)
        object.__module_obj.SetWindControllerWind_Strength(object.wind_strength)
        object.__module_obj.SetWindControllerWind_Decay(object.wind_decay)
        object.__module_obj.SetWindControllerWind_Frequency(object.wind_frequency)
        object.__module_obj.SetWindControllerWind_Turbulence(object.wind_turbulence)
        object.__module_obj.SetWindControllerTranslate_X(object.wind_x)
        object.__module_obj.SetWindControllerTranslate_Y(object.wind_y)
        object.__module_obj.SetWindControllerTranslate_Z(object.wind_z)

    def set_windcontroller_wind_activate(object, bActivate):
        object.wind_activate = bActivate

    def set_windcontroller_wind_type(object, windType):
        object.wind_type = windType

    def set_windcontroller_wind_strength(object, strength):
        object.wind_strength = strength

    def set_windcontroller_wind_decay(object, decay):
        object.wind_decay = decay

    def set_windcontroller_wind_frequency(object, frequency):
        object.wind_frequency = frequency

    def set_windcontroller_wind_turbulence(object, turbulence):
        object.wind_turbulence = turbulence

    def set_windcontroller_translate_x(object, x):
        object.wind_x = x

    def set_windcontroller_translate_y(object, y):
        object.wind_y = y

    def set_windcontroller_translate_z(object, z):
        object.wind_z = z

    def set_skin_offset(object, offset):
        object.avatar_skin_offset = offset

    def on_move_garment(object):
        object.__module_obj.SetMoveGarment(True)

    def finish_animation_recording(object): #Callback function called when recording is finished
        #object.__module_obj.StopRecord()
        print("finish_animation_recording")
        object.SimulationOff(0)
        if object.__current_process < len(object.job_tuple_list_):
            object.__current_process += 1
            object.save_single_file()
            object.run_()
        else:
            object.__module_obj.FinishAllProcess() #If you want to terminate the program after all processes are finished, you must call it.


    def set_file_load_flag(object, _file_load_complete):
        object.file_load_complete = _file_load_complete

    def is_file_load_complete(object):
        return object.file_load_complete

    def finish_animation_play(object): #Callback function called when playing is animation
        object.process_second_job()

    def run_(object):
        print("run_ start")
        print(object.__current_process)
        print(len(object.job_tuple_list_))
        if object.__current_process >= len(object.job_tuple_list_):
            object.__module_obj.FinishAllProcess() #If you want to terminate the program after all processes are finished, you must call it.
            return

        print("New Scene")
        object.__module_obj.NewScene()

        new_file_path = "";
        #Do not change the File open order
        for index in range(0, len(object.job_tuple_list_[object.__current_process])):
            path =  object.job_tuple_list_[object.__current_process][index]
            object.run_app_open_option()
            ret = object.__module_obj.OpenFile(path, 0)
            if ret == False:
                print("Failed File Open : " + path)

            new_file_path += object.get_file_name_except_ext(path)

        print(new_file_path)

        object.set_save_file_name(new_file_path)
        #object.__module_obj.SetSimulationQuality(object.simulation_quality_list[object.__current_process])
        object.__module_obj.SimulationOff(0)
        object.UpdateTimeWarp()
        object.StartAnimationRecord(0)


    # when finish animation recording call back function
    def finished_force_animation_recording(object):
        print("finished_force_animation_recording")
        #object.copyFrame(1)
        #object.pasteFrame(31)
        #object.pasteFrame(61)
        #object.pasteFrame(190)
        object.set_animation_recording(True)


    def set_animation_recording(object, on):
        object.__module_obj.SetAnimationRecording(on)

    def set_save_obj_sequence(object, bAnimation):
        object.save_obj_sequence = bAnimation

    def set_save_file_name(object, source_file_name):
        if os.path.isdir(object.save_folder_path) == True:
            target_file_name = object.save_folder_path + source_file_name + "." + object.save_file_extension
            print("New file path to be saved!")
            print(target_file_name)
            object.__module_obj.SetSaveFilePath(target_file_name, object.save_file_extension, False)

    def get_base_name(object, target_file_name):
        split_string = target_file_name.split(".")
        ext = split_string[len(split_string) - 1]

        head, _sep, tail = target_file_name.rpartition(ext)

        return head

    def moveFrame(object, frame): #move frame
        object.__module_obj.MoveFrame(frame)

    def copyFrame(object, frame):
        object.__module_obj.CopyFrame(frame)

    def pasteFrame(object, frame):
        object.__module_obj.PasteFrame(frame)

    #Function to set the frame to end recording
    def set_frame_to_finish(object, frame, bOn):
        object.__module_obj.SetFrameToFinish(frame, bOn)

    def setSkinOffset(object, offset):
        object.__module_obj.SetSkinOffset(offset)

    def SaveBoneInformation(object, filePath):
        target_file_name = object.save_folder_path + object.get_base_name(object.get_file_name(filePath)) + "boi"
        print(target_file_name)
        object.__module_obj.SaveBoneInformation(target_file_name)

    def replaceRight(object, original, old, new, count_right):
        repeat=0
        text = original

        count_find = original.count(old)
        if count_right > count_find :
            repeat = count_find
        else :
            repeat = count_right

        for _ in range(repeat):
            find_index = text.rfind(old)
            text = text[:find_index] + new + text[find_index+1:]

        return text

    def SetTimeWarp(object, timeWarpValue):
        object.time_warp = timeWarpValue
        object.updateTimeWarp = True

    def UpdateTimeWarp(object):
        object.__module_obj.SetTimeWarp(object.time_warp)

    def ExtractFabricImageFile(object, folderPath):
        object.__module_obj.SaveUsedFabricImageFiles(folderPath)

    def LoadZfabFileDataOnly(object, filePath):
        object.__module_obj.LoadZfabFileWithoutProperties(filePath)

    def Extract(object):
        print(len(object.open_fabric_file_list))

        for i in range(0, len(object.open_fabric_file_list)):
            fabricName = object.open_fabric_file_list[i]
            print(fabricName)
            object.__module_obj.InitFabricLibrary()
            object.LoadZfabFileDataOnly(fabricName)
            object.ExtractFabricImageFile(object.save_image_folder_path)

    def ChangeFabricImage(object):
        print(object.save_folder_path)
        print(len(object.open_fabric_file_list))
        print(object.save_fabric_folder_path)
        print(object.save_image_folder_path)
        fileList = object.get_entry_list(object.save_image_folder_path)

        for i in range(0, len(fileList)):
            imapFile = fileList[i]
            if os.path.splitext(imapFile)[1] == ".imap":
                object.__module_obj.ChangeFabricImageFile(object.save_image_folder_path + fileList[i], object.save_fabric_folder_path, object.save_folder_path)



